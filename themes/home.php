<?php $v->layout("_template"); ?>


<h1 class="py-2">Minhas Tarefas</h1>

<!-- Toast -->

  <div class="toast-custom" style="position: absolute; top: 80px; right: 20px;">
    <div class="body">
        <p><i class="fas fa-check"></i> Sucesso</p>
    </div>
  </div>

<div id="tasks">
    <div class="form-group" style="position: relative">
    <form method="post" @submit.prevent>
        <input type="text" name="title" class="form-control" @keyup.enter="SendTask" v-model="form.task" placeholder="Nova tarefa..." />
        <span class="text-danger input-required" v-if="alertRequired">Campo obrigatório!</span>
        <button type="button" class="btn btn-outline-success btn-add-task border-0" @click.prevent="SendTask"><i class="fa fa-plus"></i></button>
    </form>
    </div>
    
    <div v-if="loading" >
        <Preloader />
    </div>
    <div v-else>
    <table class="table table-hovered" v-if="tasks.length">
        <tbody>
            <tr v-for="task in tasks" :key="task.id">
                <template v-if="!task.edit">
                <td>
                    <input type="checkbox" :value="task.id" :id="task.id" @change="handlerCheck(task)" :checked="task.status == 1" > 
                    <label :for="task.id" :class="{checked: task.status == 1 ? true : false}">{{ task.title }}</label>
                </td>
                <td>
                    <button class="btn btn-outline-primary border-0" @click="startUpdate(task.id)" ><i class="fas fa-edit"></i></button>
                    <button class="btn btn-outline-danger border-0" @click="del(task.id)"><i class="fas fa-trash"></i></button>
                </td>
                </template>
                <template v-else>
                <div class="form-group" style="position: relative; width: 100%">
                    <form method="post" id="edit-task">
                        <input type="text" @keyup.enter="update(task.id)" name="title" class="form-control" v-model="edit.title" autofocus />
                        <div class="buttons-edit">
                            <button class="btn btn-outline-success btn-edit-task border-0" @click.prevent="update(task.id)" ><i class="fas fa-check"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-close-edit border-0" @click.prevent="closeEdit"><i class="fa fa-times"></i></button>
                        </div>
                    </form>
                </div>
                </template>
            </tr>
        </tbody>
    </table>
    <p v-else>Nenhuma tarefa criada!</p>
    </div>
</div>