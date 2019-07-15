# Customer Tags for Magento 2.3.x
Customer Tags is a user-friendly solution to easly manage Tags for Customers and Guests to Categories them. Manuel and Automatic asigning, deleting and editing of Tags without any need to change the Magento code base. 
With Customer Tags you can create youre own tags and add them to your customers as you wish. 

We have added a grid to add tags under Customer->Client Tags->Tags
## You can create or edit or delete Tags like this
                            
![Rookiesoft Customer Tags](https://i.ibb.co/K7XLcqB/Add-tag-view.png)

For guests we have added a new grid found under Customer->Client Tags->GuestCustomer
## You can add Tags to guests like this
We also added a link to sales order detail view <!-- think of an better sentance later -->

![Rookiesoft Customer Tags](https://i.ibb.co/x5kXmVN/Guest-customer-view.png)

### What's next
* Adding tags to registered customers
  * with an tab in Customers->All Customer->edit
* Filter for Tags

### Features
* Quick and easy setup
* Add tag via grid and/or observer

## Installation
You can install the module with composer (recommended) or manually.

#### Step 1
##### Using Composer (recommended)
```
    composer require rookiesoft/magento2-customertags
```

##### Manually  (not recommended)
 * Download the extension
 * Unzip the file
 * Create a folder {Magento 2 root}/app/code/RookieSoft/CustomerTags
 * Copy the content from the unzip folder

#### Step 2
cd to {Magento 2 root}
```
    php -f bin/magento module:enable --clear-static-content RookieSoft_CustomerTags
    bin/magento setup:upgrade
```

Now you are ready to use the module
