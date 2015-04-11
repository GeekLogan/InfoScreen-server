# InfoScreen Server Response API

## Calling
* Calls to `getInfo.php` responds in `application/json` according to the following schema

## Schema
### Server Variables
*Single object of following format:*

Key | Value | Format
--- | --- | ---
notificationIsActive | Status of Current Notification | `true` or `false`
notificationTest | Text of Current Notification | String
notificationSender | Owner of Current Notification | String
twitchChannel | Current Displayed Twitch Channel | String

### Calendar
`Modeled as Array of following:`

Key | Value | Format
--- | --- | ---
time | Start Time of event | Hour:Minute (Relative Day)
person | Owner of Event | String
timeEnd | End Time of Event | Hour:Minute
location | Location of Event | String
