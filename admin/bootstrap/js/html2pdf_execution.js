function generatePDF() {
// Choose the element that your form is rendered in.
const element = document.getElementById("siplPrint");
// Choose the element and save the PDF for our user.
html2pdf()
  .set({ html2canvas: { scale: 3 } })
  .from(element)
  .save();
}