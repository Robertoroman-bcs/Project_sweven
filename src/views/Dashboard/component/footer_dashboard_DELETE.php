�    ��   �           �      �               �            �           �           �           �                             '�:�v3k�=          ߰m�>  � B     �    ��   �           p      �               �           �           �           �                             '�:�v3k�=                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ct(1, "days"),
                          moment().subtract(1, "days"),
                      ],
                      "Last 7 Days": [moment().subtract(6, "days"), moment()],
                      "Last 30 Days": [moment().subtract(29, "days"), moment()],
                      "This Month": [
                          moment().startOf("month"),
                          moment().endOf("month"),
                      ],
                      "Last Month": [
                          moment().subtract(1, "month").startOf("month"),
                          moment().subtract(1, "month").endOf("month"),
                      ],
                  },
                  startDate: moment().subtract(29, "days"),
                  endDate: moment(),
              },
              function(start, end) {
                  $("#reportrange span").html(
                      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
                  );
              }
          );

          //Timepicker
          $("#timepicker").datetimepicker({
              format: "LT",
          });

          //Bootstrap Duallistbox
          $(".duallistbox").bootstrapDualListbox();

          //Colorpicker
          $(".my-colorpicker1").colorpicker();
          //color picker with addon
          $(".my-colorpicker2").colorpicker();

          $(".my-colorpicker2").on("colorpickerChange", function(event) {
              $(".my-colorpicker2 .fa-square").css("color", event.color.toString());
          });

          $("input[data-bootstrap-switch]").each(function() {
              $(this).bootstrapSwitch("state", $(this).prop("checked"));
          });
      });
      // BS-Stepper Init
      document.addEventListener("DOMContentLoaded", function() {
          window.stepper = new Stepper(document.querySelector(".bs-stepper"));
      });

      // DropzoneJS Demo Code Start
      Dropzone.autoDiscover = false;

      // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
      var previewNode = document.querySelector("#template");
      previewNode.id = "";
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);

      var myDropzone = new Dropzone(document.body, {
          // Make the whole body a dropzone
          url: "/target-url", // Set the url
          thumbnailWidth: 80,
          thumbnailHeight: 80,
          parallelUploads: 20,
          previewTemplate: previewTemplate,
          autoQueue: false, // Make sure the files aren't queued until manually added
          previewsContainer: "#previews", // Define the container to display the previews
          clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
      });

      myDropzone.on("addedfile", function(file) {
          // Hookup the start button
          file.previewElement.querySelector(".start").onclick = function() {
              myDropzone.enqueueFile(file);
          };
      });

      // Update the total progress bar
      myDropzone.on("totaluploadprogress", function(progress) {
          document.querySelector("#total-progress .progress-bar").style.width =
              progress + "%";
      });

      myDropzone.on("sending", function(file) {
          // Show the total progress bar when upload starts
          document.querySelector("#total-progress").style.opacity = "1";
          // And disable the start button
          file.previewElement
              .querySelector(".start")
              .setAttribute("disabled", "disabled");
      });

      // Hide the total progress bar when nothing's uploading anymore
      myDropzone.on("queuecomplete", function(progress) {
          document.querySelector("#total-progress").style.opacity = "0";
      });

      // Setup the buttons for all transfers
      // The "add files" button doesn't need to be setup because the config
      // `clickable` has already been specified.
      document.querySelector("#actions .start").onclick = function() {
          myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
      };
      document.querySelector("#actions .cancel").onclick = function() {
          myDropzone.removeAllFiles(true);
      };
      // DropzoneJS Demo Code End
  </script>
  <!-- DataTables  & Plugins -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-responsive/js/dataTables.responsive.min.js">
  </script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
  </script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- InputMask -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/moment/moment.min.js"></script>
  <script src="<?php echo $URL ?>/src/public/template/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?php echo $URL ?>/src/public/template/plugins/daterangepicker/daterangepicker.js"></script>
  <script>
      $(function() {
          $("#example1").DataTable({
              "responsive": true,
              "lengthChange": false,
              "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
          });
      });
  </script>
  <script>

  </script>
  </body>

  </html>