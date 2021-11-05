### Create Hogia Lön Plus xml document

Install with composer: `composer require jongotlin/hogia`

```php
$fileInfo = new \JGI\Hogia\Model\FileInfo();
$fileInfo->setCompanyName('Foo company');
$payTypeInstruction = new \JGI\Hogia\Model\PayTypeInstruction('111', 'A', '123');
$hogiaDocument = (new \JGI\Hogia\Generator())->createHogiaDocument($fileInfo, [$payTypeInstruction]);

echo $hogiaDocument->saveXML()
```
