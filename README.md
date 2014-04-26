Glass-Beach
===========

Glassware for Toronto Glass Hackathon V2: Beach Water Quality

## Intro

Results from daily water samples taken at Toronto's beaches is made available as part of the City's [Open Data Initiative and Open311](http://www1.toronto.ca/wps/portal/contentonly?vgnextoid=80bd0ea14b661310VgnVCM1000003dd60f89RCRD&vgnextchannel=8517e03bb8d1e310VgnVCM10000071d60f89RCRD).
 Our team decided to take this information, correlate it with positonal data from GPS, and create
 a data-driven, location-based piece of Glassware that reports swimming conditions in a user-friendly way
 to a user standing at one of Toronto's 11 beaches.

## Mirror API (backend)

### Design

The Mirror API was scaffolded from the [mirror-api-php](https://github.com/googleglass/mirror-quickstart-php) sample application (at 6ebe5a) and modified to suit our needs.

Upon receiving a request from the Google API listener, containing either: 

1. the numeric id of a beach (from a menu); or 
2. geographic coordinates (from GPS)

the Glass-Beach Mirror API contacts Toronto's Open Data source for beach water quality and extracts its status {`Safe`/`Unsafe`} and any advisory messages.

### Installing

```bash
git-clone --recursive git@github.com:michaelsanford/Glass-Beach.git \
 && cd  Glass-Beach/mirror-api-php  \
 && vagrant up
```

Then, log in to the [Google API Console](https://code.google.com/apis/console/) create an OAuth 2 key and ensure that you have checked off "Mirror API" in the Services tab. Add appropriate values to `config.php`.

## Glassware (frontend)

### Invocation
`"Ok, Glass: How's the water?"`

### Building
Import the project from `Glass-Beach/Glassware` into Android Studio, making sure you've installed *Android 4.2.2 (API 19)* and the *Glass Development Kit Preview* from the SDK Manager.

Cross your fingers.

Build.

### Design
The application was scaffolded from the [gdk-apidemo-sample](https://github.com/googleglass/gdk-apidemo-sample) (at db3cc0) and modified by [Steven]() and [Skyler]().

## Contributing

Feel free to fork (and send pull requests)! Bugs and new features are listed in the [Issue Tracker](https://github.com/michaelsanford/Glass-Beach/issues). If you'd like to add something, feel free.

## Colophon
Steven Zarichney | Slyker Fitchett | Michael Sanford
