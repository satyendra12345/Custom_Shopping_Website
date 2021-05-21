Statistics Module
------------

-Lets proceed with an Installation .

## Install

Add to your config file:

```php
...
$config['modules']['statistics'] = [
	'class' => 'app\modules\statistics\Module'
];
    ...
],
```
##Place in your layouts 

```
use app\modules\statistics\models\Visitor;
<?=Visitor::counter();?>
```