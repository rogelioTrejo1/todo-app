// Dependencias
import { API_URL } from "../config/keys";

// Instancias
const URL_API = new URL("/api", API_URL);

/**
 * 
 * @returns 
 */
export const getTaks = async (): Promise<Task[]> => {
    const URL_GET_TASKS = new URL("/getTasks.php");

    const resp: Response = await fetch(URL_GET_TASKS.href);
    const tasks: Task[] = await resp.json();
    return tasks;
};

/**
 * 
 * @param id 
 */
export const getTask = async (id: number): Promise<Task> => {
    // Establesco las datos
    const URL_GET_TASK = new URL("/getTask.php", URL_API);
    URL_GET_TASK.searchParams.set("id", `${id}`);

    const resp: Response = await fetch(URL_GET_TASK.href);
    const task: Task = await resp.json();

    return task;
};

export const postTask = (task: Task) => {

};

export const putTask = (task: Task) => {

};

export const deleteTask = (id: number) => {

};

export const patchDoneTask = () => {

};

// Definición de tipos de datos
export type Task = {
    id: number;
    title: string;
    description: string;
    done: boolean;
};
