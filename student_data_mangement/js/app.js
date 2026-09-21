const text = "Modern PHP | MySQL | JavaScript Project";
let i = 0;

function type() {
    const el = document.getElementById("typing");
    if (!el) return;
    if (i < text.length) {
        el.innerHTML += text.charAt(i);
        i++;
        setTimeout(type, 70);
    }
}
type();

// Glass Effect
const glass = document.querySelector(".glass");

if (glass) {
    document.addEventListener("mousemove", (e) => {
        let x = (window.innerWidth / 2 - e.pageX) / 35;
        let y = (window.innerHeight / 2 - e.pageY) / 35;

        glass.style.transform = `rotateY(${x}deg) rotateX(${-y}deg)`;
    });
}

// Counter
function counter(id, end) {
    const el = document.getElementById(id);
    if (!el) return;

    let i = 0;
    const step = Math.max(1, Math.ceil(end / 40));

    const speed = setInterval(() => {
        i += step;
        if (i >= end) {
            el.innerHTML = end;
            clearInterval(speed);
        } else {
            el.innerHTML = i;
        }
    }, 20);
}

// STUDENT_TOTAL is set inline in index.php from the real database count
counter("student", typeof STUDENT_TOTAL !== "undefined" ? STUDENT_TOTAL : 0);
counter("session", 8);
counter("course", 5);

// Add Student modal (no more scrolling to a separate section)
function openAddModal() {
    const overlay = document.getElementById("addStudentOverlay");
    if (overlay) overlay.classList.add("active");
}

function closeAddModal() {
    const overlay = document.getElementById("addStudentOverlay");
    if (overlay) overlay.classList.remove("active");
}

document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById("addStudentOverlay");
    if (!overlay) return;

    // Click outside the modal box closes it
    overlay.addEventListener("click", (e) => {
        if (e.target === overlay) closeAddModal();
    });
});

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeAddModal();
});
