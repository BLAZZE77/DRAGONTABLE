const pages = document.querySelectorAll('.wizardpage');
const steps = document.querySelectorAll('.wizardstep');
const formPage = document.querySelector('.newcharacter');
let current = 0;

function showPage(index) {
    pages.forEach(p => p.classList.remove('active'));
    steps.forEach(s => s.classList.remove('active'));
    pages[index].classList.add('active');
    steps[index].classList.add('active');
}

document.querySelectorAll('.btn-wizard-next').forEach(btn => {
    btn.addEventListener('click', () => {
        if (current < pages.length - 1) {
            current++;
            showPage(current);
            
            if (current > 0) {
                formPage.style.backgroundImage = 'none';
            }
        }
    });
});

document.querySelectorAll('.btn-wizard-prev').forEach(btn => {
    btn.addEventListener('click', () => {
        if (current > 0) {
            current--;
            showPage(current);
          
            if (current === 0) {
                const bgImage = raceitems[raceindex].dataset.bg;
                if (bgImage) {
                    formPage.style.backgroundImage = `url('${bgImage}')`;
                }
            }
        }
    });
});

const raceitems = document.querySelectorAll('.raceitem');
const raceinfos = document.querySelectorAll('.raceinfo');
let raceindex = 0;

function showRace(index) {
    raceitems.forEach(r => r.style.display = 'none');
    raceinfos.forEach(r => r.style.display = 'none');
    raceitems[index].style.display = 'block';
    raceinfos[index].style.display = 'block';
    
    const bgImage = raceitems[index].dataset.bg;
    if (bgImage && formPage) {
        formPage.style.backgroundImage = `url('${bgImage}')`;
    }
}

showRace(0);

document.getElementById('raceprev').addEventListener('click', () => {
    raceindex = (raceindex - 1 + raceitems.length) % raceitems.length;
    showRace(raceindex);
});

document.getElementById('racenext').addEventListener('click', () => {
    raceindex = (raceindex + 1) % raceitems.length;
    showRace(raceindex);
});

document.getElementById('raceselect').addEventListener('click', () => {
    const id = raceitems[raceindex].dataset.id;
    document.querySelector('#character_race').value = id;
});

document.querySelectorAll('.tarotcard').forEach(card => {
    card.addEventListener('click', () => {
        document.querySelectorAll('.tarotcard').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        document.querySelector('#character_classe').value = card.dataset.id;
    });
});