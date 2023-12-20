    window.jsPDF = window.jspdf.jsPDF;

    var doc = new jsPDF();
    var texte = document.querySelector('autorisationp');
        
    doc.text(20, 20, 'Hello world!');
    doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');

    // Add new page
    doc.addPage();
    doc.text(20, 20, texte.innerHTML);

    // Save the PDF
    doc.save('facture.pdf');


    let fleche2=document.querySelector('.fleche2')

    fleche2.style.opacity=0.8