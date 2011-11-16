A lot of websites have resorted to using AJAX for almost all navigation, and thus alienating users without JavaScript and search engines alike.
Some workarounds have come up, such as the hashbang (#!), combined with efforts from Google to make such pages indexable with \_fragment\_identifier\_.
Unfortunately, making these work can often be a hassle, and the resulting code is rarely well structured.

Snavi tries to address this by providing a simple framework for enabling AJAX loading of pages when possible, and doing this in a way that minimizes code duplication.
On its own, Snavi does very little apart from providing a wrapper to navigation that allows you to only update the parts of a page that need updating.
The important part here is the "standard" way of using Snavi that will lead to a very well structured and accessible site:

Backend
=======

In order to use Snavi as efficiently as possible, your application should be constructed in a fashion that:
 - Has strict separation between controllers and views
 - Allows outputting only the data for a page (preferrably in JSON)
 - Use a templating language that has bindings both for your language of choice *and* for Javascript.
 - Have a way of fetching the "raw" template for a page, without any surrounding layout

Application flow
================

Now, on to the application flow.
There are a couple of scenarios:

1. The user does not have JS enabled
2. The user has JS enabled, and is navigating to a page with a different layout from the current one
3. The user has JS enabled, and is navigating to a page with the same layout, but different content

With Snavi, these would flow as follows:

Scenario one
------------
The user clicks a link
The browser navigates to whatever is in the links href attribute
The backend loads the controller, renders the HTML page view, wraps the layout around it and send the whole thing back to the client
User receives the page and is happy

Scenario two
------------
The user clicks a link
A click event handler cancels the click event, and calls snavi.navigate
Snavi detects that a different layout is about to be shown
Snavi loads the template for the target layout (either from cache or through a function call)
Snavi calls a tear down function for the previous layout (to stop any running animations, remove styles or whatnot)
Snavi calls a set up function for the target layout 
The set up function renders the template (using Mustache or some other templating language), changes page title, etc.
_Note: The developer can also do things like animations and such here if she wants_
The user sees the new page and is happy

Scenario three
--------------
The user clicks a link
A click event handler cancels the click event, and calls snavi.navigate
Snavi detects that the same layout is being used
Snavi calls a modify function with the data received from the backend (or setup if the current layout cannot be modified, but has to be re-rendered)
Modify function changes only the parts of the page that are different based on the dataset
The user sees that the relevant parts of the page have changed and is happy

Why?
====

The one thing that Snavi provides is a way of ensuring that you always only ever update the parts of a page that *have* to be changed based on the exact nature of the navigation (i.e. taking context into account).
By using a templating language that also works in Javascript, your templates can be reused client side, saving a lot of traffic between the backend and the client, and thus reducing load and page render times.
Templates can also be cached on the client side, increasing perceived performance even further, and saving more round-trips to the backend.

Snavi also comes with automatic history management, meaning you will never have to worry about breaking your users' back buttons again!
Behind the scenes, snavi will try to use the most up-to-date technology, but fall back to things like hashlocation should it be necessary.

Notes
=====

Snavi is still under development, and needs to be tried on a larger project.
Until I find such a project myself, feel free to try it out and see if it works on your project, and let me know how it was to work with!

Also, it needs a new name. Suggestions?
