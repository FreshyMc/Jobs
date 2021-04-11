let doc = document;

let form = doc.querySelector('.form');
let inputs = Array.from(doc.querySelectorAll('.form input'));
let textarea = doc.querySelector('.form textarea');
let errorBox = doc.getElementById('error-box');

errorBox.addEventListener('click', (ev)=> { ev.target.style.display = 'none'});

inputs.forEach(input => input.addEventListener('blur', () => validateInput(input)));

textarea.addEventListener('blur', () => validateInput(textarea));

form.addEventListener('submit', validateForm);

function validateForm(ev){
    ev.preventDefault();

    let error = false;

    inputs.map(i => {
        if(validateInput(i)){
            error = true;
        }
    });

    if(validateInput(textarea)){
        error = true;
    }

    if(error){
        errorBox.textContent = 'All fields are required!';
        errorBox.style.display = 'block';
    }else{
        ev.target.submit();
    }
}

function validateInput(input){
    if(!input.value.trim()){
        input.classList.add('error');

        return true;
    }else{
        input.classList.remove('error');

        return false;
    }
}