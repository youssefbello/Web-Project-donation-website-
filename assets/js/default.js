const notesContainer = document.getElementById("app");
const addNoteButton = notesContainer.querySelector(".add-note");

getNotes().forEach((note) => {
    const noteElement = createNoteElement(note.id, note.content);
    notesContainer.insertBefore(noteElement, addNoteButton);
});

addNoteButton.addEventListener("click", () => addNote());

function getNotes() {
    return JSON.parse(localStorage.getItem("stickynotes-notes") || "[]");
}

function saveNotes(notes) {
    localStorage.setItem("stickynotes-notes", JSON.stringify(notes));
}


function createNoteElement(id, content) {
    const noteContainer = document.createElement("div");
    noteContainer.classList.add("note-container");

    const textarea = document.createElement("textarea");
    textarea.classList.add("note");
    textarea.value = content;
    textarea.placeholder = "Empty Sticky Note";

    const dateContainer = document.createElement("div");
    dateContainer.classList.add("note-footer");
    dateContainer.textContent = getCurrentDate();

    const deleteButton = document.createElement("button");
    deleteButton.classList.add("delete-button");
    deleteButton.innerHTML = "&times;"; // Use "×" (multiplication symbol) as the content

    // Function to generate a random hex color
    function getRandomColor() {
        return '#' + Math.floor(Math.random()*16777215).toString(16);
    }

    // Set random background color for textarea
    textarea.style.backgroundColor = getRandomColor();

    noteContainer.appendChild(deleteButton);
    noteContainer.appendChild(textarea);
    noteContainer.appendChild(dateContainer);

    deleteButton.addEventListener("click", () => {
        const doDelete = confirm("Are you sure you wish to delete this sticky note?");
        if (doDelete) {
            deleteNote(id, noteContainer);
        }
    });

    textarea.addEventListener("change", () => {
        updateNote(id, textarea.value);
    });

    return noteContainer;
}

function addNote() {
    const notes = getNotes();
    const noteObject = {
        id: Math.floor(Math.random() * 100000),
        content: "",
        date: getCurrentDate()
    };

    const noteElement = createNoteElement(noteObject.id, noteObject.content);
    notesContainer.insertBefore(noteElement, addNoteButton);

    notes.push(noteObject);
    saveNotes(notes);
}


function getCurrentDate() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, "0");
    const day = String(now.getDate()).padStart(2, "0");
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const seconds = String(now.getSeconds()).padStart(2, "0");

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}



function updateNote(id, newContent) {
    const notes = getNotes();
    const targetNote = notes.filter((note) => note.id == id)[0];

    targetNote.content = newContent;
    saveNotes(notes);
}

function deleteNote(id, element) {
    const notes = getNotes().filter((note) => note.id != id);

    saveNotes(notes);
    notesContainer.removeChild(element);
}
