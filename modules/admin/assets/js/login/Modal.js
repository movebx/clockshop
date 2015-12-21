/**
 * Created by garjo_099 on 10.11.15.
 */

function Modal(options)
{
    var self = this;
    this.modalBg = (options.background != undefined) ? options.background : true;
    this.modalWidth = options.width || '100%';
    this.modalHeight = options.height || '100%';
    this.modalColor = options.color || 'white';
    this.animateSide = options.animateSide || 'top';
    this.insertElem = options.insertElem  || null;

    this.forDelete = {};

    this.create = function ()
    {

        if(this.modalBg == true)
        {
            var modalBg = document.createElement('div');
            modalBg.style.cssText = "position: fixed; \
            width: 100%; \
            height: 100%; \
            background-color: black; \
            opacity: 0.6; \
            z-index: 1; ";

            document.body.insertBefore(modalBg, document.body.firstElementChild);
            this.forDelete.modalBg = modalBg;
        }

        var modal = document.createElement('div');

        modal.style.position = 'fixed';
        if(this.animateSide == 'top' || this.animateSide == 'bottom')
        {
            if(this.animateSide == 'top')
            {
                modal.style.right = '0';
                modal.style.left = '0';
                modal.style.bottom = '0';
            }
            else
            {
                modal.style.left = '0';
                modal.style.top = '0';
                modal.style.right = '0';
            }

            modal.style[this.animateSide] = '-' + this.modalHeight;
            modal.style.margin = '0 auto';
        }
        else
        {
            if(this.animateSide == 'left')
            {
                modal.style.right = '0';
                modal.style.top = '0';
                modal.style.bottom = '0';
            }
            else
            {
                modal.style.left = '0';
                modal.style.top = '0';
                modal.style.bottom = '0';
            }

            modal.style[this.animateSide] = '-' + this.modalWidth;
            modal.style.margin = 'auto 0';

        }

        modal.style.transition = 'all 1s cubic-bezier(0, 0, 1, 1)';
        modal.style.width = this.modalWidth;
        modal.style.height = this.modalHeight;
        modal.style.backgroundColor = this.modalColor;
        modal.style.zIndex = '2';
        modal.style.boxShadow = '0px 0px 4px black';


        document.body.insertBefore(modal, document.body.firstElementChild);
        this.forDelete.modal = modal;

        if(this.insertElem != null)
            modal.insertBefore(this.insertElem, modal.firstElementChild);

        setTimeout(function()
        {
            modal.style[self.animateSide] = '0';
        }, 200);

    };

    this.delete = function()
    {
        modal.style[self.animateSide] = '0';
        this.forDelete.modalBg.parentElement.removeChild(this.forDelete.modalBg);
        this.forDelete.modal.parentElement.removeChild(this.forDelete.modal);
    };
}