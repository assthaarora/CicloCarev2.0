var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {

 
            showTab(currentTab);
            
});

            function showTab(n) {
              var x = document.getElementsByClassName("tab");
              x[n].style.display = "block";
              if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
              } else {
                document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
              } else {
                document.getElementById("nextBtn").innerHTML = "Next";
              }
              fixStepIndicator(n)
            }

            function nextPrev(n) {
              var x = document.getElementsByClassName("tab");
              if (n == 1 && !validateForm()) return false;
              x[currentTab].style.display = "none";
              currentTab = currentTab + n;
              if (currentTab >= x.length) {
                document.getElementById("regForm").submit();
                // return false;
                //alert("sdf");
                 document.getElementById("nextprevious").style.display = "none";
                document.getElementById("all-steps").style.display = "none";
                document.getElementById("register").style.display = "none";
                 document.getElementById("text-message").style.display = "block";



                
              }
              showTab(currentTab);
            }

            function validateForm() {
              var x, y, i, valid = true;
              x = document.getElementsByClassName("tab");
              y = x[currentTab].querySelectorAll('input, select, textarea, .sortable-option, #radioOptions input[type="radio"], #govtId');
              
              for (i = 0; i < y.length; i++) {
                  if (y[i].type === "checkbox") {
                      if (!y[i].checked) {
                        y[i].classList.add("invalid");
                        valid = false;
                      } else {
                        y[i].classList.remove("invalid");
                      }
                  } else if (y[i].type === "radio") {
                      var radioGroup = document.getElementsByName(y[i].name);
                      var checked = false;
                      for (var j = 0; j < radioGroup.length; j++) {
                        if (radioGroup[j].checked) {
                          checked = true;
                          break;
                        }
                      }
                      if (!checked) {
                        y[i].classList.add("invalid");
                        valid = false;
                        document.getElementById("radioErrorMessage").style.display = "block";
                      } else {
                        y[i].classList.remove("invalid");
                        document.getElementById("radioErrorMessage").style.display = "none";
                      }
                  } else if (y[i].tagName === "SELECT") {
                      if (y[i].value === "") {
                        y[i].classList.add("invalid");
                        valid = false;
                      } else {
                        y[i].classList.remove("invalid");
                      }
                  } else if (y[i].tagName === "TEXTAREA") {
                      if (y[i].value.trim() === "") {
                        y[i].classList.add("invalid");
                        valid = false;
                      } else {
                        y[i].classList.remove("invalid");
                      }
                  } else if (y[i].classList.contains("sortable-option")) {
                      if (y[i].textContent.trim() === "") {
                        y[i].classList.add("invalid");
                        valid = false;
                      } else {
                        y[i].classList.remove("invalid");
                      }
                  } else if (y[i].type === "file") {
                      if (y[i].files.length === 0) {
                        y[i].classList.add("invalid");
                        valid = false;
                      } else {
                        y[i].classList.remove("invalid");
                      }
                  } else if (y[i].type === "hidden") {
                    y[i].classList.remove("invalid");
                  }else if (y[i].value.trim() === "") {
                      y[i].classList.add("invalid");
                      valid = false;
                  }else {
                      y[i].classList.remove("invalid");
                  }
                
                // Remove the red border as soon as the user starts filling in the data
                y[i].addEventListener("input", function() {
                  this.classList.remove("invalid");
                });
                
                if (currentTab === x.length - 1 && valid) {
                  console.log(x.length);
                  document.getElementById("nextBtn").type = "submit"; // Change button type to "submit"
                }
              }
              
              if (valid) {
                document.getElementsByClassName("step")[currentTab].classList.add("finish");
                // document.getElementById("nextBtn").type = "submit";
              }
              
              return valid;
            }

            function fixStepIndicator(n) {
              var i, x = document.getElementsByClassName("step");
              for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
              }
              x[n].className += " active";
            }