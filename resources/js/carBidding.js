window.addEventListener("load", (event) => {
    event.preventDefault();
    window.Echo.channel('CarBiddingPrice')
        .listen('.bidding', (e) => {
            console.log('Bidding event received:', e);

            // Check if the event data contains auction_id and price
            if (e.data && e.data.auction_id && e.data.price) {
                var elements = document.querySelectorAll(".auction_price_" + e.data.auction_id);

                // Log the elements found
                console.log('Elements found:', elements);

                // Iterate through the selected elements and change their text content
                elements.forEach(function(element) {
                    element.textContent = e.data.price;
                });
            } else {
                console.error('Invalid event data:', e.data);
            }
        });
})
