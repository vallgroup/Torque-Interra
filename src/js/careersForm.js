/**
 * Updates the file uploader field when a new file is selected
 * to replace the default text with the selected file name
 */

($ => {
  const fileUploader = $(
    "#careers-form form .file-picker input#tq-resume"
  ).first();

  const fileUploaderLabel = $(
    "#careers-form form .file-picker label.filename"
  ).first();

  fileUploader.change(e => {
    const labelDefault = "Click to Choose a File";

    const fileName = e.target.value.split("\\").pop();

    if (fileName) {
      fileUploaderLabel.html(fileName);
    } else {
      fileUploaderLabel.html(labelDefault);
    }
  });
})(jQuery);
