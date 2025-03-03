for (let row = 0; row < 10; row++) {
    for (let col = 0; col < 10; col++) {
        const top = row * 32;
        const left = col * 32;
        document.write(`<div class="cell" id="cell_${col}_${row}" style="top: ${top}px; left: ${left}px;"></div>`);
    }
}
