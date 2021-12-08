import {forEachBail} from "enhanced-resolve";

class Groups{
    private title: HTMLInputElement;
    private groupNumber: HTMLInputElement;
    private studentNumber:HTMLInputElement;
    private submitBtn: HTMLButtonElement;

    constructor(){
        this.setVariables();
        this.setListeners();
    }

    private setVariables(): void {
        this.title = document.querySelector("input#project_title");
        this.groupNumber = document.querySelector("input#project_group_number");
        this.studentNumber = document.querySelector("input#project_student_number");
        this.submitBtn = document.querySelector("button[type='submit']");
    }

    private setListeners(){
        this.setNumberInputListeners(this.groupNumber);
        this.setNumberInputListeners(this.studentNumber);
        this.submitBtn.addEventListener('click', this.submit);
    }

    private setNumberInputListeners(input: HTMLInputElement): void {
        input.addEventListener("change",this.checkValue);
        input.addEventListener('focusout', this.checkValue);

        input.addEventListener('keypress', this.keyboardInputCheck);
    }

    private submit(ev: MouseEvent): void{
        let title = $('#title').val();
        let groupNumber = $('#groupNumber').val();
        if(title===""){
            ev.preventDefault();
            alert("Project title cannot be empty");
            return;
        } else if(groupNumber ===""){
            ev.preventDefault();
            alert("Project number of groups cannot be empty");
            return;
        }
        let groupStudentCount:NodeListOf<HTMLInputElement>  = document.querySelectorAll("input[name='groupStudentCount[]']");
        for(let i = 0;i<groupStudentCount.length;i++){
            if(groupStudentCount.item(i).value ===""){
                ev.preventDefault();
                alert("Group student count cannot be empty");
            }
        }
    }

    private checkValue(ev: FocusEvent & {target:HTMLInputElement}): void{
        // let input = ev.target;
        // if(parseInt(input.value)<0 || input.value ===""){
        //     input.value = "1";
        // }
    }

    private keyboardInputCheck(ev: KeyboardEvent & { target :HTMLInputElement}){
        let inputTest: RegExp = /^[1-9]|[1-9]\d+$/;
        let numberTest: RegExp = /^\d$/;
        if(!numberTest.test(ev.key)) {
            ev.preventDefault();
        }

        let expectedValue = ev.target.value + ev.key;

        if(!inputTest.test(expectedValue)){
            ev.preventDefault();
        }
    }
}
var groups = new Groups();
