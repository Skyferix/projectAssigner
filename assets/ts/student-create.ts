
class StudentForm{
    private modal: HTMLInputElement;
    private createBtn: HTMLButtonElement;
    private saveBtn:HTMLInputElement;
    private closeButtons: NodeListOf<HTMLButtonElement>;
    private form: HTMLFormElement;

    constructor(){
        this.setVariables();
        this.setListeners();
    }

    private setVariables(){
        this.modal = document.querySelector('.modal');
        this.createBtn = document.querySelector('button#create');
        this.closeButtons = document.querySelectorAll("button[is='close']");
        this.saveBtn = document.querySelector("button#student_submit");
        this.form = document.querySelector("form[name='student']");
    }

    private setListeners(){
        this.createBtn.addEventListener('click',()=>{
            this.modal.classList.add("modal-active");
        });
        this.closeButtons.forEach((el)=>{
            el.addEventListener('click',()=>{
                this.modal.classList.remove("modal-active");
            });
        });
        this.form.addEventListener('submit', this.submitForm);
    }

    private submitForm(ev:Event & {target: HTMLButtonElement}){
        ev.preventDefault();

        let form = $("form[name='student']");

        let form_data = form.serialize();
        let url = window.location.href;
        let id = url.substr(url.lastIndexOf('/')+1);
        $.post({
            url: '/status/submit/' + id,
            contentType: 'application/x-www-form-urlencoded',
            data: form_data,
            success:function (data){
                location.reload();
            },
            error: function (data) {
                if(data.status === 444){
                    let errorDiv:HTMLDivElement = document.querySelector('div#UX_error');
                    errorDiv.innerText = errorDiv.innerText.replace('@var@',data.responseJSON.student_fullName);
                    errorDiv.classList.remove('d-none');
                }
            }
        })
    }

}
let studentForm = new StudentForm();
