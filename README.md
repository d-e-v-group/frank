# Frank Collective - Local / Staging

Runbook for setting up a local dev environment for Frank's staging WordPress site with MAMP.


## MAMP setup

1. [Install MAMP/MAMP PRO](https://www.mamp.info)
2. Create a directory where you'll store all of your projects. (ie. `localhost`)
3. Inside of `localhost`, create a new directory for your local instance of Frank's website (ie. `frank-local`)
4. We'll configure the rest after you clone the Github repo

---

## Clone Github repo

1. `cd` into your new directory `cd ~/Desktop/localhost/frank-local`
2. Clone the Github repo
3. Now you should have the `frank` project directory with a path that looks like `localhost/frank-local/frank`

---

## Continue setting up your local environment w/MAMP

1. Open MAMP and make sure the servers are on
2. Create a new host by clicking the `+` from `Hosts` settings
3. Enter the name of the directory where you created for Frank's local instance - `frank-local`
4. Choose the document root (the Frank repo) by clicking the folder icon that is circled in red. Continuing with our example, it should be this path: `Desktop/localhost/frank-local/frank`
5. Check the box to `Create a database`
6. Enter the database name `frankdb` and hit `Create Host`. *It's important to use the database name `frankdb` so it matches what is in the Github repo.*
7. Navigate to the `Databases` tab
8. You should see your newly created `frankdb` database checked
9. Click the `phpMyAdmin` icon to open phpMyAdmin in your browser window
10. You'll see a list on the left of the page with your databases. You should see `frankdb`. When you click the `+` to expand, you'll notice a message `No tables found in database.` Don't worry, we'll add this a little later!

---

## Export database from Frank's staging site

We first need to get the database from Frank's staging site in order to import it to our local database.

1. Log in to WP Engine (get credentials from developer):
2. Go to the `Staging` tab
3. Click the link to `phpMyAdmin`
4. This should open phpMyAdmin in a new browser window
5. Select the `wp_fcollectivedev` database from the left side
6. Click the `Export` tab
7. Use the `Quick` export method to download the sql file
8. Zip the file
9. Close out of this window. **Important: DO NOT TOUCH ANYTHING EXCEPT TO EXPORT THE DATABASE**

---

## Import database to your local environment

1. Go back to your local phpMyAdmin browser window
2. If you closed out of it, you can access it here:
- Open MAMP application
- Select `frank-local` host
- Click on `Databases` tab
- Make sure you see `frankdb` selected
- Click the phpMyAdmin logo
3. In phpMyAdmin, select your database from the left side `frankdb`
4. Click on the `Import` tab. **Make sure you are now in your local phpMyAdmin, NOT Frank's staging site phpMyAdmin. Look in the URL to ensure you see `localhost/phpMyAdmin`**
5. `Choose File` to select the compressed sql file you just exported
6. Make sure the format selected is `SQL`
7. Hit `Go`
8. You should have a `success` message!

---

## Test it out

1. Now go to the MAMP app
2. Select your host `frank-local`
3. In the `General` tab, you'll see an arrow icon next to the `Name`. Click the arrow to open in a browser window. *Note: If nothing happens when you click the arrow, you may need to stop/restart the servers from the top right hand corner*
4. You should now see your local instance of Frank's staging site in a browser window!

---

## Workflow

### Make sure the database is up to date

When you want to update your local database to match Frank's staging database, essentially you'll need to export the sql and import it locally. You should always make sure your local matches what is on the [dev site](http://fcollectivedev.wpengine.com). Keep in mind the database is just the content/data that is created in WordPress, this will not affect styles, layout, etc. Updating the database will just update the content.

Here are the steps:

1. Similar to when you initially exported the sql file, you need to go into Frank's staging site's phpMyAdmin (use credentials from above).
2. Select the `wp_fcollectivedev` database from the left side
3. Click the `Export` tab
4. Select `Custom` export method
5. Under `Tables`, de-select all `Structure`. The reason for this is that you already have the database tables (structure) setup on your local and now you just want to replace the data itself.
6. Under `Output`, click the box that says `Rename exported databases/tables/columns`
7. A pop-up window will appear. Where it says `Select database`, make sure `wp_fcollectivedev` is selected. Next to it, enter the name of your local database name `frankdb`.
8. Save & Close
9. Go to `Data creation options` section
10. Locate `Function to use when dumping data:` and select from the drop-down `REPLACE`
11. Hit `Go` to download the sql file
12. Zip the sql file
**Close Frank staging site's phpMyAdmin to ensure you do not get it mixed up with your local!**
13. In your local phpMyAdmin, select your database `frankdb` and go to the `Import` tab
14. Upload the zipped sql file that you just exported
15. You should receive a `Success` message
16. Go to your local browser and do a hard refresh to see the updated content

### Git Flow

```
feature_feature-branch > develop > master
```

Always branch off of `develop` and never directly commit to `master`. After you are satisfied with your edits, create a pull request to have a peer review your code. Once it's accepted, merge your branch into `develop`. Next, you'll need to update the files via SFTP to be reflected on Frank's [dev site](http://fcollectivedev.wpengine.com). Afterwards, you can merge `develop` into `master`.

**NOTE: Changes in the repo will not deploy the site. The site will get updated manually via SFTP.**

### Remember

- Develop has features approved to move to dev site but may have not yet been updated via SFTP
- Master should match the [dev site](http://fcollectivedev.wpengine.com)

### Local edits

1. `cd` into the directory where you have the Frank repo `cd ~/Desktop/localhost/frank-local/frank`
2. `git status` to make sure you are on `master` and the working tree is clean
3. Go to the develop branch `git checkout develop`
4. Create a new branch `git checkout -b feature_your-feature`
5. In order to change CSS or JS files, you'll need to have Gulp installed in order to compile the files. Install Gulp globally `npm install --global gulp-cli`
6. You'll edit CSS/JS from the `assets/sass` or `assets/js` directory
7. After you make any edits here, you'll need to compile these files:
- `cd` into the custom frank theme `cd ~/Desktop/localhost/frank-local/frank/wp-content/themes/frank-collective`
- run `gulp`
8. Do a hard refresh in your browser and confirm the changes are there

---

## SFTP

After everything looks good on your branch, it's been approved, and you've merged it into develop - now you need to update the staging site via SFTP

### Create SFTP user

You only need to create your new user once. Afterwards, you can always use the same user to access the SFTP.

1. Log in to WP Engine (get credentials from developer):
2. Go to the `Staging` tab
3. Click `SFTP users`
4. Create a new user `+ Add SFTP user`
5. Username should use the convention `fcollectivedev-yourname`
6. Create a password
7. `Environment` should be `Staging`

### Update files

1. Use the SFTP client of your choice (get credentials from developer):
2. Navigate to the custom theme directory: `wp-content/themes/frank-collective`.
3. Go to your finder window and drag the entire `assets` folder into the custom theme so that it updates the existing `assets` folder with your edits. *It's best to drag the entire `assets` folder since it includes the compiled files. If you think it takes too long to update because of the many images, feel free to navigate to the `/assets` directory and manually drag both the `compiled` and `sass` (or `js`) folders instead of the entire `assets` folder.*
4. Now go to your browser, do a hard refresh and make sure the edits are now up on the [dev site](http://fcollectivedev.wpengine.com/)
