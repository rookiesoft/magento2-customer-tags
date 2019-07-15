# Customer Tags for Magento 2.3.x
Customer Tags is a user-friendly solution to easly manage Tags for Customers and Guests to Categories them. Manuel and Automatic asigning, deleting and editing of Tags without any need to change the Magento code base. 
With Customer Tags you can create youre own tags and add them to your customers as you wish. 

We have added a grid to add tags under Customer->Client Tags->Tags
## Add tags
On the top rigt corner is a red button [Add Tag] wich leads to an formular. 
After everything is filled on the top left corner is the [Save] button. 
You also can use the [Back] button if you dont want to add a new tag.
### Delete tags
To delete an Tag simply click on the checkbox next to the tag that is not wanted and click on the dropdown menu above called [Actions]
and select [Delete], you get asked if you realy wish to delte the tag and it is done.
<!-- ![Rookiesoft Customer Tags](https://i.ibb.co/K7XLcqB/Add-tag-view.png) -->

For guests we have added a new grid found under Customer->Client Tags->GuestCustomer
## Guest customer grid
If you want to add your newly created, or existing tags to guests (later to registered customers too) press the
view (edit) button in the row of the customer you wish too add them.
On this side a few informations of that customer is provided just as they're email adress, pruchases made, total sales and every order id if that customer has made multiple purchases.
You can press on the [View] button to get to order view for more informations regarding the order.
### Add tags to customer
Under the title [Edit Guest Customer Tags] is an select form with search function you can select multiple tags for an customer.
<!-- We also added a link to sales order detail view --> <!-- think of an better sentance later -->

<!-- ![Rookiesoft Customer Tags](https://i.ibb.co/x5kXmVN/Guest-customer-view.png) -->

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

Now you are ready to use the module.


