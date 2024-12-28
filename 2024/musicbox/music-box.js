const canvas = document.getElementById('punch-card');
const ctx = canvas.getContext('2d');
const hiddenTextDiv = document.getElementById('hidden-text');
const gridSize = 20; // Size of the grid square
const columns = 32; // Number of columns
const rows = 10; // Number of rows
const holes = new Set(); // To keep track of punched holes

// Define the notes for each row
const notes = ["A4", "Bb4", "B4", "C5", "Db5", "D5", "Eb5", "E5", "F5", "Gb5", "G5"];

// Variables to keep track of timeouts
let timeouts = [];

// Draw grid
function drawGrid() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
    for (let x = 0; x < columns * gridSize; x += gridSize) {
        for (let y = 0; y < rows * gridSize; y += gridSize) {
            ctx.strokeRect(x + 30, y, gridSize, gridSize);
        }
    }

    // Draw note labels
    ctx.font = '12px Arial'; // Set font size to 12px
    ctx.textAlign = 'right';
    ctx.textBaseline = 'middle';
    notes.slice(0, rows).forEach((note, index) => {
        ctx.fillText(note, 25, index * gridSize + gridSize / 2);
    });
}

// Initial grid drawing
canvas.width = columns * gridSize + 30; // Adjust canvas width to fit all columns and note labels
canvas.height = rows * gridSize; // Adjust canvas height to fit all rows
drawGrid();

canvas.addEventListener('click', (e) => {
    const rect = canvas.getBoundingClientRect();
    const x = Math.floor((e.clientX - rect.left - 30) / gridSize) * gridSize;
    const y = Math.floor((e.clientY - rect.top) / gridSize) * gridSize;
    const holeKey = `${x},${y}`;
    
    if (holes.has(holeKey)) {
        holes.delete(holeKey);
        ctx.clearRect(x + 30, y, gridSize, gridSize); // Remove hole
        ctx.strokeRect(x + 30, y, gridSize, gridSize); // Redraw grid square outline
    } else {
        holes.add(holeKey);
        ctx.fillRect(x + 30, y, gridSize, gridSize); // Punch hole
    }

    // Play the corresponding note
    const noteIndex = y / gridSize;
    if (noteIndex >= 0 && noteIndex < notes.length) {
        const audio = new Audio(MIDI.Soundfont.music_box[notes[noteIndex]]);
        audio.volume = 1.0; // Set volume to maximum
        audio.play();
    }
});

function playNotes() {
    stopNotes(); // Clear any existing timeouts before starting new ones
    const noteDuration = 0.15; // Duration of each note and silence in seconds
    const sortedHoles = Array.from(holes).map(hole => {
        const [x, y] = hole.split(',').map(Number);
        return { x, y, note: notes[y / gridSize] };
    }).sort((a, b) => a.x - b.x); // Sort notes by x coordinate

    const totalColumns = columns;

    for (let i = 0; i < totalColumns; i++) {
        const columnX = i * gridSize;
        const columnNotes = sortedHoles.filter(note => note.x === columnX);

        // Schedule highlight and clear
        timeouts.push(setTimeout(() => {
            highlightColumn(columnX + 30);
        }, i * noteDuration * 2 * 1000));

        timeouts.push(setTimeout(() => {
            clearColumnHighlight(columnX + 30);
        }, (i * noteDuration * 2 + noteDuration) * 1000));

        // Play notes in the column
        columnNotes.forEach((note, index) => {
            const audio = new Audio(MIDI.Soundfont.music_box[note.note]);
            audio.volume = 1.0; // Set volume to maximum
            audio.currentTime = 0;
            const startTime = audio.currentTime + i * noteDuration * (2 - noteDuration);
            timeouts.push(setTimeout(() => {
                audio.play();
            }, i * noteDuration * 2 * 1000));
        });
    }
}

function stopNotes() {
    // Clear all timeouts
    timeouts.forEach(timeout => clearTimeout(timeout));
    timeouts = [];
    // Clear all column highlights
    for (let i = 0; i < columns; i++) {
        clearColumnHighlight(i * gridSize + 30);
    }
}

function clearNotes() {
    holes.clear(); // Clear all holes
    drawGrid(); // Redraw the grid
}

function highlightColumn(x) {
    ctx.save();
    ctx.fillStyle = 'rgba(255, 255, 0, 0.3)'; // Semi-transparent yellow for tracker
    ctx.fillRect(x, 0, gridSize, canvas.height);
    ctx.restore();
}

function clearColumnHighlight(x) {
    for (let y = 0; y < canvas.height; y += gridSize) {
        ctx.clearRect(x, y, gridSize, gridSize);
        ctx.strokeRect(x, y, gridSize, gridSize);
        if (holes.has(`${x - 30},${y}`)) {
            ctx.fillRect(x, y, gridSize, gridSize); // Redraw hole
        }
    }
}

function exportPDF() { // This is really here for the OG version of this. Probably can just comment out. 
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p', 'mm', 'a4');
    const imgData = canvas.toDataURL('image/png');
    pdf.addImage(imgData, 'PNG', 10, 10, 190, 57); // Adjust the width and height to fit the page
    pdf.save('punched-card.pdf');
}

