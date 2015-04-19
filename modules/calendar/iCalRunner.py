import iCalToXML

import xml.etree.ElementTree as ET
tree = ET.parse('calendar/calendars.xml')
root = tree.getroot()

output = []

for urlChild in root:
    file = iCalToXML.loadFileFromLink(urlChild.text)
    events = iCalToXML.getAllEvents(file)
    for event in events:
        event.owner = "tim"
    output.extend(events)

#iCalToXML.printAsXML(output)
for event in output:
    line = str(event)
    line += "<owner>"
    line += event.owner
    line += "</owner>"
    print line
