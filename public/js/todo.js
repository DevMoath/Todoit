/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/todo.js":
/*!******************************!*\
  !*** ./resources/js/todo.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$("#cp1").colorpicker();
document.querySelector("#list_color_to_edit").addEventListener("focus", function (e) {
  document.querySelector("#edit_color_picker").focus();
});
document.querySelector("#list_color").addEventListener("focus", function (e) {
  document.querySelector("#color_picker").focus();
});
var taskName = null;

function tasksInputEvent() {
  var tasksInput = document.querySelectorAll(".task-name");
  [].forEach.call(tasksInput, function (taskInput) {
    taskInput.addEventListener("focus", function (e) {
      taskName = e.target.value;
    });
    taskInput.addEventListener("blur", function (e) {
      if (taskName !== e.target.value) {
        fetch("task/".concat(e.target.dataset.id), {
          method: "put",
          headers: {
            "Accept": "*/*",
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            _token: token,
            name: e.target.value,
            list_id: e.target.dataset.list
          })
        }).then(function (response) {
          if (response.ok) {
            Swal.fire({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              icon: "success",
              title: "Task Updated"
            });
          } else {
            Swal.fire({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              icon: "error",
              title: "Task can't be updated, Try again"
            });
          }
        })["catch"](function (error) {
          return console.error(error);
        });
      }

      taskName = null;
    });
  });
}

tasksInputEvent();
document.querySelector("main").addEventListener("click", function (e) {
  if (e.target.classList.contains("check-box")) {
    var url, message;

    if (e.target.checked) {
      url = "task/".concat(e.target.dataset.id, "/complete");
      message = "Task Completed";
    } else {
      url = "task/".concat(e.target.dataset.id, "/incomplete");
      message = "Task Uncompleted";
    }

    fetch(url, {
      method: "put",
      headers: {
        "Accept": "*/*",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        _token: token
      })
    }).then(function (response) {
      if (response.ok) {
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "success",
          title: message
        });

        if (e.target.checked) {
          e.target.parentElement.parentElement.parentElement.children[1].classList.add("checked");
        } else {
          e.target.parentElement.parentElement.parentElement.children[1].classList.remove("checked");
        }
      } else {
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "error",
          title: "Task can't be updated, Try again"
        });
      }
    })["catch"](function (error) {
      return console.error(error);
    });
  }
});
document.querySelector("body").addEventListener("submit", function (e) {
  e.preventDefault();

  if (e.target.dataset.type === "edit") {
    var id = document.querySelector("#list_id_to_edit").value,
        name = document.querySelector("#list_name_to_edit").value,
        color = document.querySelector("#list_color_to_edit").value;
    fetch("list/".concat(id), {
      method: "put",
      headers: {
        "Accept": "*/*",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        _token: token,
        user_id: userId,
        name: name,
        color: color
      })
    }).then(function (response) {
      if (response.ok) {
        $("#edit_list").modal("hide");
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "success",
          title: "List updated"
        });
        return response.json();
      } else {
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "error",
          title: "List can't be updated, Try again"
        });
      }
    }).then(function (json) {
      if (json) {
        document.querySelector("#list_".concat(id, " h1")).innerText = name;
        document.querySelector("#list-tab a.active h5").innerText = name;
        document.querySelector("#list-tab a.active .fa-circle").style.color = color;
      }
    })["catch"](function (error) {
      return console.error(error);
    });
  } else if (e.target.dataset.type === "delete") {
    var _id = document.querySelector("#list_id_to_delete").value;
    fetch("list/".concat(_id), {
      method: "delete",
      headers: {
        "Accept": "*/*",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        _token: token
      })
    }).then(function (response) {
      if (response.ok) {
        $("#delete_list").modal("hide");
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "success",
          title: "List deleted"
        });
        document.querySelector("#list_".concat(_id)).remove();
        document.querySelector("#list-tab a.active").remove();
        var listTab = document.querySelector("#list-tab");

        if (listTab.children.length === 0) {
          document.querySelector("#nav-tabContent").innerHTML = "<div class='text-center mx-auto w-75 alert shadow-lg my-3 alert-dismissible fade show shadow'" + "     role='alert' id=''>" + "    <div class='card-body'>" + "        <button class='btn close float-right btn-hover rounded animate action-button' data-dismiss='alert'>" + "            <i class='fa fa-times fa-fw'></i>" + "        </button>" + "        <h5 class='card-title'>Ooops</h5>" + "        <p class='card-text'>You don't have list.</p>" + "        <button type='button' onclick='document.getElementById(\"add_list_button\").click()'" + "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" + "            Create One Now!" + "        </button>" + "    </div>" + "</div>";
          listTab.innerHTML = "<div class='text-center mx-auto w-100 alert shadow-lg my-3 alert-dismissible fade show shadow'" + "     role='alert'>" + "    <div class='card-body'>" + "        <button class='btn close float-right btn-hover rounded animate action-button' data-dismiss='alert'>" + "            <i class='fa fa-times fa-fw'></i>" + "        </button>" + "        <h5 class='card-title'>Ooops</h5>" + "        <p class='card-text'>You don't have list.</p>" + "        <button type='button' onclick='document.getElementById(\"add_list_button\").click()'" + "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" + "            Create One Now!" + "        </button>" + "    </div>" + "</div>";
        } else {
          listTab.children[0].click();
        }
      } else {
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "error",
          title: "List can't be deleted, Try again"
        });
      }
    })["catch"](function (error) {
      return console.error(error);
    });
  } else if (e.target.dataset.type === "delete-task") {
    var _id2 = document.querySelector("#task_id_to_delete").value;
    fetch("task/".concat(_id2), {
      method: "delete",
      headers: {
        "Accept": "*/*",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        _token: token
      })
    }).then(function (response) {
      if (response.ok) {
        $("#delete_task").modal("hide");
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "success",
          title: "Task Deleted"
        });
        var task = document.querySelector("#task_".concat(_id2));
        var container = task.parentElement;
        task.remove();

        if (container.children.length <= 1) {
          container.innerHTML += "<div class='text-center mx-auto w-100 alert shadow-lg my-3 alert-dismissible fade show shadow'" + "     role='alert'>" + "    <div class='card-body'>" + "        <button class='btn close float-right btn-hover rounded animate action-button' data-dismiss='alert'>" + "            <i class='fa fa-times fa-fw'></i>" + "        </button>" + "        <h5 class='card-title'>Ooops</h5>" + "        <p class='card-text'>You don't have tasks.</p>" + "        <button type='button' onclick='document.getElementById(\"add_task_button\").click()'" + "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" + "            Create One Now!" + "        </button>" + "    </div>" + "</div>";
        }
      } else {
        Swal.fire({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          icon: "error",
          title: "Task can't be deleted, Try again"
        });
      }
    })["catch"](function (error) {
      return console.error(error);
    });
  }
});
var deleteModal = $("#delete_list"),
    editModal = $("#edit_list"),
    deleteTask = $("#delete_task");
deleteModal.on("show.bs.modal", function (e) {
  document.querySelector("#list_id_to_delete").value = e.relatedTarget.dataset.id;
  document.querySelector("#delete_list kbd").innerText = e.relatedTarget.dataset.name;
});
deleteModal.on("shown.bs.modal", function (e) {
  document.querySelector("#delete_list button[data-dismiss='modal']").focus();
});
deleteModal.on("hidden.bs.modal", function (e) {
  document.querySelector("#list_id_to_delete").value = "";
  document.querySelector("#delete_list kbd").innerText = "";
});
deleteTask.on("show.bs.modal", function (e) {
  document.querySelector("#task_id_to_delete").value = e.relatedTarget.dataset.id;
  document.querySelector("#delete_task kbd").innerText = e.relatedTarget.parentElement.previousElementSibling.value;
});
deleteTask.on("shown.bs.modal", function (e) {
  document.querySelector("#delete_task button[data-dismiss='modal']").focus();
});
deleteTask.on("hidden.bs.modal", function (e) {
  document.querySelector("#task_id_to_delete").value = "";
  document.querySelector("#delete_task kbd").innerText = "";
});
editModal.on("show.bs.modal", function (e) {
  document.querySelector("#list_id_to_edit").value = e.relatedTarget.dataset.id;
  document.querySelector("#list_name_to_edit").value = e.relatedTarget.dataset.name;
  $("#cp2").colorpicker("setValue", e.relatedTarget.dataset.color);
  document.querySelector("#list_color_to_edit").value = e.relatedTarget.dataset.color;
});
editModal.on("shown.bs.modal", function (e) {
  document.querySelector("#list_name_to_edit").focus();
});
editModal.on("hidden.bs.modal", function (e) {
  document.querySelector("#list_id_to_edit").value = "";
  document.querySelector("#list_name_to_edit").value = "";
  document.querySelector("#list_color_to_edit").value = "";
  $("#cp2").colorpicker("setValue", "#000000");
});
$("#add_list").on("shown.bs.modal", function (e) {
  document.querySelector("#new_list_name").focus();
});
$("#add_task").on("shown.bs.modal", function (e) {
  document.querySelector("#task_name").focus();
});
$("#settings").on("shown.bs.modal", function (e) {
  document.querySelector("#name").focus();
}); // Create List

document.querySelector("#list_color").addEventListener("focus", function (e) {
  document.querySelector("#color_picker").focus();
});
document.querySelector("#add_list form").addEventListener("submit", function (e) {
  e.preventDefault();
  var name = document.querySelector("#new_list_name").value;
  var color = document.querySelector("#list_color").value;
  fetch("list", {
    method: "post",
    headers: {
      "Accept": "application/json, text/plain, */*",
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      _token: token,
      user_id: userId,
      name: name,
      color: color
    })
  }).then(function (response) {
    if (String(response.status)[0] === "2") {
      $("#add_list").modal("hide");
      document.querySelector("#new_list_name").value = "";
      Swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: "success",
        title: "List created"
      });
      return response.json();
    } else {
      Swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: "error",
        title: "List can't be created, Try again"
      });
    }
  }).then(function (response) {
    if (response) {
      var empty_message = document.querySelector("#list-tab .alert-dismissible");

      if (empty_message) {
        empty_message.remove();
      }

      var listTab = document.getElementById("list-tab");
      var tabContent = document.getElementById("nav-tabContent");
      var child = tabContent.children[0];

      if (child.classList.contains("alert-dismissible")) {
        child.remove();
      }

      var isFirst = listTab.children.length === 0;
      var tabHtml = "\n                    <a class=\"list-group-item list-group-item-action text-muted rounded-0 border-left-0 border-right-0 border-top-0 mb-2\" data-toggle=\"tab\"\n                       href=\"#list_".concat(response.list.id, "\" role=\"tab\">\n                        <div class=\"d-flex\">\n                            <div class=\"mr-3 my-auto\">\n                                <i class=\"fas fa-circle scale-1-5\" style=\"color: ").concat(response.list.color, "\"></i>\n                            </div>\n                            <div>\n                                <h5 class='mb-1'>").concat(response.list.name, "</h5>\n                                <small>").concat(response.list.created, "</small>\n                            </div>\n                        </div>\n                    </a>\n                ");
      listTab.innerHTML += tabHtml; // tabContent.innerHTML += response.html.replace("$isFirst", isFirst ? "show active" : "");

      tabContent.innerHTML += response.html;

      if (isFirst) {
        document.querySelector("a[href='#list_".concat(response.list.id, "']")).click();
      }
    }
  });
}); // Create Task

document.querySelector("#add_task form").addEventListener("submit", function (e) {
  e.preventDefault();
  var list_id = document.querySelector("#list-tab a.active").href.split("_")[1];
  var name = document.querySelector("#task_name").value;
  fetch("task", {
    method: "post",
    headers: {
      "Accept": "application/json, text/plain, */*",
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      _token: token,
      list_id: list_id,
      name: name
    })
  }).then(function (response) {
    if (response.ok) {
      $("#add_task").modal("hide");
      document.querySelector("#task_name").value = "";
      Swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: "success",
        title: "Task created"
      });
      return response.json();
    } else {
      Swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: "error",
        title: "Task can't be created, Try again"
      });
    }
  }).then(function (json) {
    if (json) {
      var empty_message = document.querySelector("#list_".concat(list_id, " .alert-dismissible"));

      if (empty_message) {
        empty_message.remove();
      }

      document.querySelector("#list_".concat(list_id)).innerHTML += json.html;
      tasksInputEvent();
    }
  })["catch"](function (error) {
    return console.error(error);
  });
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/todo.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/m.alhajri/code/Todoit/resources/js/todo.js */"./resources/js/todo.js");


/***/ })

/******/ });