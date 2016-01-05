(function()
{
    var tableCart = document.getElementById('cart');
    tableCart.addEventListener('keyup', function(event){
        var target = event.target;

        if(target.tagName === 'INPUT')
        {
            var price = target.parentElement.previousSibling.innerHTML;
            var sumElem = target.parentElement.nextSibling;
            var sum = price * target.value;

            if(isNaN(sum))
            {
                target.value = 1;
                var e = new Event('keyup', {bubbles: true});
                target.dispatchEvent(e);
            }
            else
                sumElem.innerHTML = sum;

            var sums = this.querySelectorAll('td[data-sum="this"]');
            sums.forEach = Array.prototype.forEach;
            var total = 0;
            sums.forEach(function(item, i){
                total += (+item.innerHTML);
            });

            document.getElementById('total').innerHTML = 'Итого: ' + total;
        }
    });
    //##########################################



})();