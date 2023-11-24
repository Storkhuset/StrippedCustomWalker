# StrippedCustomWalker
A stripped and "dumbed down" extension of the WordPress Walker Nav Menu Class. All cool and smart solutions from the original Walker for adding attributes are stripped away in favor of readability.
Many of the default css classes are removed and some are renamed. 

List of CSS Classes<br>
• menu-item<br>
• menu-item--home<br>
• menu-item--current<br>
• menu-item--has-children<br>
• menu-item--level-{$depth}<br>

For the css classes I have included I have treated the additions like ”home” and ”current” like modifiers since I think that makes it more readable. The only ”real” addition to the css classes is the ”level” selector that tells what sub menu level the menu item lives in. 

There is also some additional features in the class that is not in use but can be added by the user. These features are for example adding the target page excerpt and featured image. They are commented out so that they don’t make unnecessary database calls. 

I have also added a role of presentation to the menu item and a role of navigation to the sub menu ul element. I suggest you to add that to the top level ul element as well. You do that in the wp_nav_menu() function with the ”items_wrap” option. 
Simply add: ```’items_wrap' => '<ul id="%1$s" class="%2$s" role="navigation">%3$s</ul>’``` to the options array. 

I realize that most intermediate to advanced developers will see this Walker as a step down in functionality but then again, it’s not aimed at them.
