document.getElementById('addTaskBtn').addEventListener('click', function() {
    const taskInput = document.getElementById('taskInput');
    const taskText = taskInput.value.trim();
    
    if (taskText !== "") {
        addTask(taskText);
        taskInput.value = "";
    }
});

function addTask(taskText) {
    const taskList = document.getElementById('taskList');
    const li = document.createElement('li');
    
    li.innerHTML = `
        <span>${taskText}</span>
        <button class="delete">Excluir</button>
    `;
    
    li.querySelector('button.delete').addEventListener('click', function() {
        li.remove();
    });
    
    li.querySelector('span').addEventListener('click', function() {
        li.querySelector('span').classList.toggle('completed');
    });
    
    taskList.appendChild(li);
}
