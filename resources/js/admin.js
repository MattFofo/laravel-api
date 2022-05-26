/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'bootstrap';





//delete overlay confirmation


const eleConfirmationDelete = document.querySelector('#confirmation-delete');
if (eleConfirmationDelete) {

    const eleBtnNotDelete = document.querySelector('#btn-not-delete');
    const formDelete = eleConfirmationDelete.querySelector('form');
    document.querySelectorAll('.btn-delete').forEach(element => {
        element.addEventListener('click', function () {
            const idFromSlug = element.closest('tr').dataset.id;
            const formDeleteAction = formDelete.dataset.base.replace('*****', idFromSlug);
            formDelete.action = formDeleteAction;

            eleConfirmationDelete.classList.toggle('invisible');
        })
    });
    eleBtnNotDelete.addEventListener('click', function () {
        formDelete.action = '';
        eleConfirmationDelete.classList.toggle('invisible');
    })
}



//sostituire spazi bianchi dello slug
// const eleSlug = document.querySelector('#slug');

// if (eleSlug) {
//     document.querySelector('.btn').addEventListener('click', function () {
//         eleSlug.value = eleSlug.value.replace(/ /g, '-');
//     })

// }


//generate slug
const btnGenerateSlug = document.querySelector('#generateSlug');

if (btnGenerateSlug) {
    const eleSlug = document.querySelector('#slug');

    btnGenerateSlug.addEventListener('click', function () {
        const postTitle = document.querySelector('#title').value;
        eleSlug.value = postTitle.replace(/ /g, '-');
    })
}
