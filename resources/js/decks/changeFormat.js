import { rebindDeleteEvents } from "./utils";

export default function changeFormat() {
    const formatSelect = document.getElementById("formatSelect");
    const deckId = document.getElementById("deck-id")?.value;
    if (formatSelect) {
        formatSelect.addEventListener("change", function () {
            fetch(`/decks/${deckId}/update-format`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    format: this.value,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data.message);
                })
                .catch((err) => {
                    console.error("Error updating format:", err);
                });
            fetch(`/decks/deck-details/${deckId}/cards-html`)
                .then((res) => res.text())
                .then((html) => {
                    document.getElementById("deck-card-list").innerHTML = html;
                    rebindDeleteEvents();
                });
        });
    }
}
