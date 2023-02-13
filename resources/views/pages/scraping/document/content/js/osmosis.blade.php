<script>
    var osmosis = require('osmosis');

    osmosis.get('https://ieeexplore.ieee.org/document/9636915') // url of the site you want to scrape  
        .find('//*[@id="LayoutWrapper"]/div/div/div/script[6]/text()') // selector
        .set('title') // name of the key in the results
        .data(function(results) { //output
            console.log(results);
        });
</script>
