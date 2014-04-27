<?php
/*
* Copyright (C) 2013 Google Inc.
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*      http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
//  Author: Jenny Murphy - http://google.com/+JennyMurphy

require_once 'config.php';
require_once 'mirror-client.php';
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_MirrorService.php';
require_once 'util.php';
require_once 'beaches.php';

$client = get_google_api_client();

// Authenticate if we're not already
if (!isset($_SESSION['userid']) || get_credentials($_SESSION['userid']) == null) {
	header('Location: ' . $base_url . '/oauth2callback.php');
	exit;
} else {
	verify_credentials(get_credentials($_SESSION['userid']));
	$client->setAccessToken(get_credentials($_SESSION['userid']));
}

// A glass service for interacting with the Mirror API
$mirror_service = new Google_MirrorService($client);

// But first, handle POST data from the form (if there is any)
switch ($_POST['operation']) {
	case 'insertItem':
		$new_timeline_item = new Google_TimelineItem();
		$new_timeline_item->setText($_POST['message']);

		$notification = new Google_NotificationConfig();
		$notification->setLevel("DEFAULT");
		$new_timeline_item->setNotification($notification);

		if (isset($_POST['imageUrl']) && isset($_POST['contentType'])) {
			insert_timeline_item($mirror_service, $new_timeline_item,
				$_POST['contentType'], file_get_contents($_POST['imageUrl']));
		} else {
			insert_timeline_item($mirror_service, $new_timeline_item, null, null);
		}

		$message = "Timeline Item inserted!";
		break;
	case 'insertItemWithAction':
		$new_timeline_item = new Google_TimelineItem();
		$new_timeline_item->setText("What did you have for lunch?");

		$notification = new Google_NotificationConfig();
		$notification->setLevel("DEFAULT");
		$new_timeline_item->setNotification($notification);

		$menu_items = array();

		// A couple of built in menu items
		$menu_item = new Google_MenuItem();
		$menu_item->setAction("REPLY");
		array_push($menu_items, $menu_item);

		$menu_item = new Google_MenuItem();
		$menu_item->setAction("READ_ALOUD");
		array_push($menu_items, $menu_item);
		$new_timeline_item->setSpeakableText("What did you eat? Bacon?");

		$menu_item = new Google_MenuItem();
		$menu_item->setAction("SHARE");
		array_push($menu_items, $menu_item);

		// A custom menu item
		$custom_menu_item = new Google_MenuItem();
		$custom_menu_value = new Google_MenuValue();
		$custom_menu_value->setDisplayName("Drill Into");
		$custom_menu_value->setIconUrl($service_base_url . "/static/images/drill.png");

		$custom_menu_item->setValues(array($custom_menu_value));
		$custom_menu_item->setAction("CUSTOM");
		// This is how you identify it on the notification ping
		$custom_menu_item->setId("safe-for-later");
		array_push($menu_items, $custom_menu_item);

		$new_timeline_item->setMenuItems($menu_items);

		insert_timeline_item($mirror_service, $new_timeline_item, null, null);

		$message = "Inserted a timeline item you can reply to";
		break;
	case 'insertTimelineAllUsers':
		$credentials = list_credentials();
		if (count($credentials) > 10) {
			$message = "Found " . count($credentials) . " users. Aborting to save your quota.";
		} else {
			foreach ($credentials as $credential) {
				$user_specific_client = get_google_api_client();
				$user_specific_client->setAccessToken($credential['credentials']);

				$new_timeline_item = new Google_TimelineItem();
				$new_timeline_item->setText("Did you know cats have 167 bones in their tails? Mee-wow!");

				$user_specific_mirror_service = new Google_MirrorService($user_specific_client);

				insert_timeline_item($user_specific_mirror_service, $new_timeline_item, null, null);
			}
			$message = "Sent a cat fact to " . count($credentials) . " users.";
		}
		break;
	case 'insertSubscription':
		$message = subscribe_to_notifications($mirror_service, $_POST['subscriptionId'],
			$_SESSION['userid'], $base_url . "/notify.php");
		break;
	case 'deleteSubscription':
		$message = $mirror_service->subscriptions->delete($_POST['subscriptionId']);
		break;
	case 'insertContact':
		insert_contact($mirror_service, $_POST['id'], $_POST['name'],
			$base_url . "/static/images/chipotle-tube-640x360.jpg");
		$message = "Contact inserted. Enable it on MyGlass.";
		break;
	case 'deleteContact':
		delete_contact($mirror_service, $_POST['id']);
		$message = "Contact deleted.";
		break;
	case 'deleteTimelineItem':
		delete_timeline_item($mirror_service, $_POST['itemId']);
		$message = "A timeline item has been deleted.";
		break;

	case 'insertBeach':
		$new_timeline_item = new Google_TimelineItem();

		$status = get_beach_status($_POST['beachId'], $_POST['lat'], $_POST['long']);
		// STATUS RETURNS:
		// 0 Name
		// 1 Status
		// 2 Icon URL
		// 3 Advisory

		if ($status != null) {
			$html = $status[0] . ": " . $status[1];
		} else {
			$html = "This is not the beach you are looking for...";
			$status[2] = "https://raw.githubusercontent.com/michaelsanford/Glass-Beach/master/mirror-api-php/assets/nobeach-icon.jpg";
		}

		$new_timeline_item->setText($html);

		$notification = new Google_NotificationConfig();
		$notification->setLevel("DEFAULT");
		$new_timeline_item->setNotification($notification);

		insert_timeline_item($mirror_service, $new_timeline_item,
			"image/jpeg", file_get_contents($status[2]));

		$message = "Timeline Item inserted!";
		break;
}

//Load cool stuff to show them.
$timeline = $mirror_service->timeline->listTimeline(array('maxResults' => '3'));
try {
	$contact = $mirror_service->contacts->get("php-quick-start");
} catch (Exception $e) {
	// no contact found. Meh
	$contact = null;
}
$subscriptions = $mirror_service->subscriptions->listSubscriptions();
$timeline_subscription_exists = false;
$location_subscription_exists = false;
foreach ($subscriptions->getItems() as $subscription) {
	if ($subscription->getId() == 'timeline') {
		$timeline_subscription_exists = true;
	} elseif ($subscription->getId() == 'locations') {
		$location_subscription_exists = true;
	}
}

?>
