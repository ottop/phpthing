<!DOCTYPE html>
<html>
    <head>
        <title>PHP Ebay Parser</title>
    </head>
    <body>
        <?php
            $url = 'https://www.ebay.com/';
            
            $dom = new DOMDocument();
            
            libxml_use_internal_errors(true);
            $dom->loadHTMLFile($url);
            libxml_use_internal_errors(false);
            
            // Create a DOMXPath
            $xpath = new DOMXPath($dom);

            $itemLinkClass = 'vlp-merch-item-tile'; 
            $itemNameClass = 'vlp-merch-item-title';
            
            $items = $xpath->query("//a[contains(concat(' ', normalize-space(@class), ' '), ' $itemLinkClass ')]");
            
            foreach ($items as $item) {
                $itemLink = $item->getAttribute('href');
                
                // Find the item name within the current item container
                $itemNameNode = $xpath->query(".//h3[contains(concat(' ', normalize-space(@class), ' '), ' $itemNameClass ')]", $item)->item(0);
                $itemName = $itemNameNode ? $itemNameNode->textContent : '';
    
                // Display the item link and name
                echo "Item name: $itemName<br>";
                echo "Item link: $itemLink<br><br>;";
            }

        ?>
    </body>
</html>