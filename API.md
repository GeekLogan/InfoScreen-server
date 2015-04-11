# InfoScreen Server Response API

### Calling
* Calls to `getInfo.php` responds in `application/json` according to the following schema

### Schema
#### Server Variables

#### Calendar
`Modeled as Array of following:`

Key | Value | Format
--- | --- | ---
Time | Start Time of event | Hour:Minute (relative day)
Person | Owner of Event | String
TimeEnd | End Time of Event | Hour:Minute
