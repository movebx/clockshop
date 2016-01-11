(function()
{
    var tableCart = document.getElementById('cart');
    tableCart.addEventListener('keyup', function(event){

        event.stopPropagation();
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

    var confirmButton = document.getElementById('confirm-button');
    confirmButton.addEventListener('click', function(event)
    {

        var target = event.target;
        var contactData = {
            c_name: document.getElementById('c-name'),
            c_phone: document.getElementById('c-phone')
        };

        if(contactData.c_name.value.length < 1)
        {
            contactData.c_name.style.border = '1px solid red';

            document.getElementById('c-name-hint').innerHTML = '<strong><i>Пожалуйста, введите Ваше имя!</i></strong>'

            event.preventDefault();
        }


        if(!contactData.c_phone.value.match(/^\+?\d{5,}$/i))
        {
            contactData.c_phone.style.border = '1px solid red';

            document.getElementById('c-phone-hint').innerHTML = '<strong><i>Телефон должен быть правильным!</i></strong>'

            event.preventDefault();
        }





    });



})();