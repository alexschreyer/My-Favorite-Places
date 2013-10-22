My Favorite Places web app
==========================

Version: 2.0

Copyright 2010-2013, Alexander C. Schreyer, All rights reserved

THIS SOFTWARE IS PROVIDED "AS IS" AND WITHOUT ANY EXPRESS OR IMPLIED WARRANTIES,
INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS FOR A PARTICULAR PURPOSE.

License: GPL (http://www.gnu.org/licenses/gpl.html)

Author: Alexander Schreyer, www.alexschreyer.net, mail@alexschreyer.net

Website: http://umass.edu/myfavoriteplaces

Description: A PHP/MySQL-based web app that lets visitors vote for their favorite
places by putting pins on a map. The votes can include comments and the results
can be plotted as a heatmap.

Features:
- Google Maps API-based location survey
- Demographic data in survey
- Location-based pin preset if close to default location
- Display of most recent submissions
- Display of tweets geotagged in area
- Responsive mobile website
- Hidden admin area
- Data filtering in admin area
- Heatmap plot in admin area
- Database backup and KML download feature

Setup: Publish to web and set up MySQL database using config.sql file. Then adjust
config.php file's contents to your liking. Don't forget to adjust the survey options on 
the submit.php page. If you add/remove any, adjust the db as well. 

For admin view, go to map-admin.php. You can back the DB up using dbdump.php.

Todo:
- Twitter feeds are not working because of new auth model.
- Heatmap should be filtered as well.
- Can heatmap graphics be smoother?

History:

Version 2.0 (10/21/2013):
- Cleaned up code significantly and made pages more modular.
- Set up default center location in config file.
- Moved all images and INCs to subfolder.
- Bad words filtering now for names and descriptions.
- Took out UMass references

Version 1.0:
- Initial release on umass.edu/myfavortiteplaces