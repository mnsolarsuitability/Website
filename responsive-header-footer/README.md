# Responsive Header and Footer Standards and Instructions
The responsive header and footer have been developed for units to use when building mobile or responsive websites.

## Standards
### Responsive header
On screens the size of a tablet and larger, the mobile header appears with the same features included in the standard web header: the block M, wordmark and Driven to Discover combination, search, myU and One Stop buttons, and the campus links. There is an intermediate stage below 660px width where all the elements remain but the search field becomes smaller to allow for a wider stretch of screen sizes in which the complete header elements can remain visible.

For smaller screen devices, the size of the block M, wordmark, and Drived to Discover has been reduced. The breakpoint is 520px, at which point the branding elements are reduced to their minimum dimensions of 250x50 pixels. The campus links and buttons for One Stop and myU have been removed.

#### Search
There are two options for search. You may use a header that includes a search button that, when activated, will display a search field and button below the header. In this option, the search button in the upper-tier of the header is replaced with a "Cancel" button, and depending on screen width, repositions next to the search field (this happens between 380px and 520px; below 380px the "Cancel" button retains its position in the upper right.

Alternatively, you may use the option that removes the search button from the header and has a search field and button always open below the header. In this case, there is no search button in the upper right of the header. In usability testing, this option was favored by focus groups.

The also may be some instances in which search is best left out entirely for small screen devices, and the code within the NoSearch branch covers that case.

### Responsive Footer
For small screens (in this implementation, below 660px), the mobile footer requires a shortened copyright and equal opportunity statement. A link to the University's privacy policy is required. A modified date is not required.

The links to maps, parking, contact, and directories have also been removed.

### Link recommendations
University units should decide when and how to offer links that have been removed from the small screen versions of the header and footer. For example, units that have a lot of student traffic may want to continue to provide links to One Stop or myU. It's up to the individual unit as to where these links may best fit with their mobile site design.

A secondary footer is the recommended location for these links.

### Download and Branding Requirements
Downloads for the mobile header and footer graphics and code are available on the [Our Brand](https://www.ur.umn.edu/brand/) site or in the [University Relations GitHub repository](https://github.umn.edu/URel/HeaderFooter).

#### Central Hosting
Images, scripts, stylesheets, and sample code for the Header and Footer are also hosted at http://a.umn.edu/templates/web/responsive/current/ and these assets may be referenced in your website rather than hosting them on your own server.

#### Required
Do not alter the graphics or change the color of the block M, wordmark, Driven to Discover, or background.

## Technical Instructions
Within this repository the header display options each have different branches. The Master branch reflects the current released code for the "Dropdown" version, where the search button is a toggle for the search field to appear below the header. Additional development on this version will happen in the Dropdown branch but merged into Master when the code is released.

The Two-Tier branch contains the version in which the search field remains persistent below the header and lacks a toggle button.

The SourceOrder branch contains a variation on the Dropdown code in which the Header appears *after* page content in the source, but absolutely positioned at the top of the page.

There has been some development on a CSS only version (branch cssonly) for experimental use. This version does not yet have the most current assets merged into it. Similarly, a full-width version (branch fullwidth) is also under development but should be considered incomplete and not yet up to brand standard.

### JavaScript
The JavaScript for implementing the dropdown header is included in the file `js/umnhf.js` or alternatively a minified version `js/umnhf.min.js`. This was written to not be dependent on any libraries; if you are already using jQuery in your page, you may prefer to use the version in `js/umnhf-jq.js`, which you will likely want to copy into your own `$(document).ready()` code.

### Styles
Styles are designed for maximum (excessive?) specificity, unlikely to override or be overridden. In any case in which you do need to override the CSS for some reason (tread carefully), it will require both an ID and a class.

An IE6 stylesheet is included in the Master/Dropdown and Two-Tier versions (Wordmark sprite is a transparent png; a separate version exists for IE6 support). In the SourceOrder version, an IE7 tweak was necessary, and the fixes for IE6 were rolled into the IE7 stylesheet (there should be no case where it is necessary to use both `IE7.css` and `IE6.css`)