import { Task } from "./Api";

/**
 * Genera un HTML de las tareas que se le pasan por parametro
 * @param tasks Tareas que se van a pintar
 * @returns HTML de las tareas
 */
export const makeHtmlTasks = (tasks: Task[]): string => {
    // Templete para cuando no existen tareas
    const NO_TASKS = `
        <tr rowspan="4">
            <td colspan="4" class="text-center">
                <h3>No tasks</h3>
            </td>
        </tr>
    `;

    return tasks.length === 0
        ? NO_TASKS
        : tasks.map(({ id, description, title, done }) => `
            <tr>
                <td class="w-25">
                    <strong>${title}</strong>
                </td>
                <td class="w-25">
                    <p>${description}</p>
                </td>
                <td class="w-25">
                    <div class="form-check form-switch">
                        <input _id="${id}" class="changeStatus form-check-input" ${done ? "checked" : ""} type="checkbox" id="${id}">
                        <label class="form-check-label" for="${id}">${done ? "Done" : "To do"}</label>
                    </div>
                </td>
                <td class="w-25">
                    <div class="row">
                        <div class="col-6">
                            <button _id="${id}" class="btn-edit w-100 btn btn-primary">Edit</button>
                        </div>
                        <div class="col-6">
                            <button _id="${id}" class="btn-delete w-100 btn btn-danger">Delete</button>
                        </div>
                    </div>
                </td>
            </tr>
        `).join("");
};