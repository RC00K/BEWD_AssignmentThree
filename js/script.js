// HTML Tags
const todoInput = document.querySelector('.todo-input');
const todoInputDesc = document.querySelector('.tododesc-input');
const todoForm = document.querySelector('.todo-form');
const todoList= document.querySelector('.todo-list');
const body = document.getElementsByTagName('body')
const header = document.getElementsByTagName('header')
const todoItem = document.getElementsByTagName('li')
const todoDesc = document.getElementsByTagName('p')
const footer = document.getElementsByTagName('footer')
const tabs = document.querySelector('.tabs')


// Event listener
document.addEventListener('DOMContentLoaded', getTodos)
todoForm.addEventListener('submit', addTodo)
todoList.addEventListener('click', deleteCheck)

// Add new todo
function addTodo(e){
    e.preventDefault()
    
    const todoDiv = document.createElement('div')
    todoDiv.classList.add('todo')

    const newTodo = document.createElement('li')
    newTodo.innerText = todoInput.value
    newTodo.classList.add('todo-item')
    todoDiv.appendChild(newTodo)

    saveToLocal(todoInput.value)

    const newDesc = document.createElement('p')
    newDesc.innerText = todoInputDesc.value
    newDesc.classList.add('todo-desc')
    todoDiv.appendChild(newDesc)

    saveToLocal(todoInputDesc.value)

    const close= document.createElement('button')
    close.setAttribute('aria-label', 'close-button')
    close.innerHTML = `<span class="x">&#x2715</span>`
    close.classList.add('close-btn')
    todoDiv.appendChild(close)
    
    todoList.appendChild(todoDiv)

    todoInput.value= ''
    todoInputDesc.value= ''
}

// Delete todo
function deleteCheck(e){
    const item = e.target

    if(item.classList[0] === 'close-btn'){
        const todo = item.parentElement
        removeLocalTodos(todo)
        todo.remove()
    }
}

// Save to local
function saveToLocal(todo){
    let todos

    if(localStorage.getItem('todos') === null){
        todos = []
    } else {
        todos = JSON.parse(localStorage.getItem('todos'))
    }
    todos.push(todo)
    localStorage.setItem('todos', JSON.stringify(todos))
}

// Get todo
function getTodos(){
    let todos
    if(localStorage.getItem('todos') === null){
        todos = []
    } else {
        todos = JSON.parse(localStorage.getItem('todos'))
    }
    todos.forEach(function(todo){
        const todoDiv = document.createElement('div')
        todoDiv.classList.add('todo')

        //create the list item for each todo
        const newTodo = document.createElement('li')
        newTodo.innerText = todo
        newTodo.classList.add('todo-item')
        todoDiv.appendChild(newTodo)

        const newDesc = document.createElement('p')
        newDesc.innerText = todo
        newDesc.classList.add('todo-desc')
        todoDiv.appendChild(newDesc)

        //create the close button <i class="fa fa-close">&close</i>
        const close= document.createElement('button')
        close.setAttribute('aria-label', 'close-button')
        close.innerHTML = `<span class="x">&#x2715</span>`
        close.classList.add('close-btn')
        todoDiv.appendChild(close)

        //append new todo to the list
        todoList.appendChild(todoDiv)
    })
}

// Remove from local
function removeLocalTodos(todo){
    let todos
    if(localStorage.getItem('todos') === null){
        todos = []
    } else {
        todos = JSON.parse(localStorage.getItem('todos'))
    }
    const todoIndex =todo.children[0].innerText
    todos.splice(todos.indexOf(todoIndex), 1)
    localStorage.setItem('todos', JSON.stringify(todos))
}