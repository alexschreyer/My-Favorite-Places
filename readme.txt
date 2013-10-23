My Favorite Places web app
==========================

Version: 2.2

Copyright 2010-2013, Alexander C. Schreyer, All rights reserved

THIS SOFTWARE IS PROVIDED "AS IS" AND WITHOUT ANY EXPRESS OR IMPLIED WARRANTIES,
INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS FOR A PARTICULAR PURPOSE.

License: GPL (http://www.gnu.org/licenses/gpl.html)

Author: Alexander Schreyer, www.alexschreyer.net, mail@alexschreyer.net

Description: A PHP/MySQL-based web app that lets visitors vote for their favorite
places by putting pins on a map. The votes can include comments and the results
can be plotted as a heatmap.

Website: http://www.alexschreyer.net/projects/finding-our-favorite-places/

Features:
- Google Maps API-based location survey
- Ability to include emographic data in survey
- Location-based pin preset if close to default location
- Display of most recent submissions
- Display of tweets geotagged in area
- Responsive mobile website/web app
- Badword filtering and some spam protection
- Possibility for IP range filtering
- Sharing of content using ShareThis
- Hidden admin area (not password protected!)
- Data filtering in admin area
- Heatmap plot in admin area
- Database backup and KML download feature

Setup: Publish to web and set up MySQL database using config.sql file. Then adjust
config.php file's contents to your liking. Don't forget to modify the footer.php file for
your organization. To modify theme, adjust style.css.

Usage: For admin view, go to map-admin.php. You can back the DB up using dbdump.php. Please
note: The KML data can only be viewed when this code is hosted on a public server (not on a local
testing server).

Todo:
- Use prepared MySQLi statements for process.php.
- Twitter feeds are not working because of new auth model.

History:

Version 2.2 (10/23/2013):
- Switched to v. 3.exp of Maps API
- Uses Googles heatmap implementation now
- Heatmap now shows filtered data
- Fixed minor bugs

Version 2.1 (10/22/2013):
- Minor security improvements
- Demographic fields now in config file
- Fixed ShareThis code

Version 2.0 (10/21/2013):
- Cleaned up code significantly and made pages more modular.
- Set up default center location in config file.
- Moved all images and INCs to subfolder.
- Bad words filtering now for names and descriptions.
- Took out UMass references.

Version 1.0:
- Initial release on http://www.umass.edu/myfavoriteplaces