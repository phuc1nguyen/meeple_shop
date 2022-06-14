# Meeple Shop

  Meeple Shop is an online boardgame store inspired by other boardgame stores like Boardlandia and TabletopMerchant.


## Features

  Admin CRUD to manage content on home page:
  - Products (cate_id = 1: Pre-Orders section | cate_id = 0: New Releases section)
  - Sliders 
  - Tutorials (embedded videos)
  - Users (type = 0: admin | type = 1: customer)

  User profile for customers to update their informations


## Local Setup

  Meeple Shop is built with pure PHP, HTML and JS so set up as normal project. For database you can import [meeple_db.sql](https://github.com/phuc1nguyen/meeple_shop/blob/master/database/meeple_db.sql) file in database folder.

  Change the necessary configurations (database, email) in [config.inc.php](https://github.com/phuc1nguyen/meeple_shop/blob/master/database/meeple_db.sql) file.


## Improvement

  As one of my first projects to hone my skill in pure PHP, MySQL, there are few things I wish to further improve (leave for future projects):
  - Cart for buying boardgames
  - Online payments with Stripe using stripe/stripe-php
  - Store images on separate locations for frontend and backend (for now they're all in backend/public/img)
  - Not showing errors to frontend when something went wrong
