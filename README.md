AvatarGen
=========

AvatarGen is an easy-to-use set of PHP classes for creating and serving up custom avatars (profile images) for use on websites or other services. With a single request, the user can provide a username string, a style, and a size, and a custom and unique avatar image will be instantly generated and returned. This would be great for online forums, chat sites, etc.

Styles
======

AvatarGen was built in a way that allows for avatar styles to be easily added or modified. Currently, there are only two supported styles, as listed below.

* <tt>circles</tt> - A basic avatar containing different circles with different radii and fill colors. Also includes a default background color.
* <tt>crisscross</tt> - A basic, 8 color avatar style that generates what appears to be 16 uniquely colored squares. This is done by taking 4 uniquely colored rows, and overlaying them with 4 uniquely colored columns which are at 50% opacity.

Usage
=====

An AvatarGen request usually looks something like this:

    http://www.myhost.com/avatar.php?style=circles&str=username&w=90&h=90

The `style` parameter specifies the avatar style, and can be any of the supported AvatarGen styles. The `str` parameter is used to generate a unique image, and the `w` and `h` parameters are the width and height for the generated image.
