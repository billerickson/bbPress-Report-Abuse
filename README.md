bbPress Report Abuse
====================

This plugin provides a "Report Abuse" link in bbPress replies. It is designed to be used with <a href="http://www.wordpress.org/plugins/bbpress">bbPress</a> and <a href="http://www.gravityforms.com">Gravity Forms</a>. 

Instructions
-------------
1. Download and install plugin.
2. Create a page called "Report Abuse" (URL = /report-abuse). If you want to use a different URL, use the `bbpress_report_abuse_url` filter to change the default
3. Create a Gravity Form. Add whatever fields you'd like users to fill out. One of them should be "Reported URL". Click the "Advanced" tab, check "Allow field to be populated dynamically", and specify `bbp_report_abuse` as the parameter name.
4. Add your new form to the Report Abuse page.

Now users can click the "Report Abuse" link above any reply in your forums. They are taken to the Report Abuse page with the reporting form, and the reported URL is filled out for them already.

Customization Filters
-------------

* `bbpress_report_abuse_label` - change the phrase "Report Abuse" to something else
* `bbpress_report_abuse_url`  – change the URL of the form (defaults to /report-abuse)
