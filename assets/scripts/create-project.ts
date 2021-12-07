import {forEachBail} from "enhanced-resolve";

class Groups{
    private groups: NodeListOf<HTMLDivElement>;
    private parentDiv: HTMLDivElement;
    private groupNumber: HTMLInputElement;
    private submitBtn: HTMLButtonElement;

    private rawGroupHTML = "<div class=\"group mt-3 d-flex\">\n" +
        "                    <div class=\"mr-3 d-flex align-items-center\">\n" +
        "                        Group 1\n" +
        "                    </div>\n" +
        "                    <div>\n" +
        "                        <label for=\"numberOfStudents\">Max. number of students</label>\n" +
        "                        <input name=\"groupStudentCount[]\" class=\"form-control\" value=1 placeholder=\"Enter student number\">\n" +
        "                    </div>\n" +
        "                </div>"

    constructor(){
        this.setVariables();
        this.setListeners();
    }

    private setVariables(): void {
        this.parentDiv = document.querySelector("div#groups");
        this.groups = this.findGroups();
        this.groupNumber = document.querySelector("input#groupNumber");
        this.submitBtn = document.querySelector("button[type='submit']");
    }

    private setListeners(): void {
        this.groupNumber.addEventListener("change",()=>{
            this.checkValue(this.groupNumber);
            this.checkGroups();
        });

        this.groups.forEach((el)=>{
            let studentNumber:HTMLInputElement = el.querySelector("input[name='groupStudentCount[]']");
            this.setNumberListener(studentNumber);
        });

        this.groupNumber.addEventListener('keypress', this.keyboardInputCheck);

        this.groupNumber.addEventListener('focusout', ()=>{
            this.checkValue(this.groupNumber);
            this.checkGroups();
        });

        this.submitBtn.addEventListener('click', this.submit);
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

    private checkValue(input:HTMLInputElement): void{
        if(parseInt(input.value)<0 || input.value ===""){
            input.value = "1";
        }
    }

    private checkGroups():void{
        let groupNumber = parseInt(this.groupNumber.value);
        let groups = this.findGroups();

        let groupCount = groups.length;
        if(groupCount<groupNumber){
            for(let i=groupCount; i<groupNumber;i++){
                this.parentDiv.insertAdjacentHTML('beforeend', this.rawGroupHTML);
                let studentNumber: HTMLInputElement = this.parentDiv.lastElementChild.querySelector("[name='groupStudentCount[]']");
                let groupTitle: HTMLDivElement = this.parentDiv.lastElementChild.querySelector("div");
                groupTitle.innerHTML = "Group " + (i+1);
                this.setNumberListener(studentNumber);
            }
        } else if(groupCount>groupNumber && groupNumber>0){
            let diff = groupCount - groupNumber;
            for(let i=0;i<diff;i++){
                this.parentDiv.removeChild(this.parentDiv.lastChild);
            }
        }
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
    private setNumberListener(input:HTMLInputElement):void{
        input.addEventListener('keypress', this.keyboardInputCheck);
        input.addEventListener('focusout', ()=>{this.checkValue(input)});
    }

    private findGroups():NodeListOf<HTMLDivElement>{
        return this.parentDiv.querySelectorAll("div.group");
    }
}
var groups = new Groups();
