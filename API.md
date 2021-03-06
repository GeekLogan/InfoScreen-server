# InfoScreen Server Response API

## Calling
* Calls to `getInfo.php` responds in `application/json` according to the following schema:
* If authentication is enabled, `auth=#` where `#` is the authentication token must be added to
the request or the server will return an error.

## Schema
### Server Variables
*Modeled as single object of following format:*

Key | Value | Format
--- | --- | ---
alertIsActive | Status of Current Alert | `true` or `false`
alertText | Text of Current Alert | String
alertSender | Owner of Current Alert | String
twitchChannel | Current Displayed Twitch Channel | String
defaultStop | Default stop id for bus info | int

### Calendar
*Modeled as Array of following:*

Key | Value | Format
--- | --- | ---
start | Start Time of event | ISO Timestamp
owner | Owner of Event | String
end | End Time of Event | ISO Timestamp
name | A description of the event | String
color | The HTML color spec to use when displaying | HTML Color `<#aaaaaa>`

### Weather
*Modeled as single object of following format:*

Key | Value | Format
--- | --- | ---
currentTemp | Current Local Temperature | String
highTemp | Today's High Temperature | String
lowTemp | Today's Low Temperature | String
description | Description of Weather | String

#### Forecast
*The following schema is used for forecasts returned by weather*

*Modeled as an array of following:*

Key | Value | Format
--- | --- | ---
day | Day of the Week | String
highTemp | Today's High Temperature | String
lowTemp | Today's Low Temperature | String
description | Description of Weather | String

###Bus Predictions
*Bus Predictions are governed by the `?stpid=#` operator to the get request, defaults to `valueStore.xml->defaultStop`*

*Modeled as a single object of following format:*

Key | Value | Format
--- | --- | ---
time | Predicted time of bus at the stop | *EX:* `20150418 18:45`
route | The route of the prediction | Letter-wise code of bus route
stop | The stop number | int
direction | The direction the bus is traveling | String
vid | The bus VID | int
