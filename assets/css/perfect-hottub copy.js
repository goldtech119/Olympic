//  perfect-hottub-form script
function createWatchedVariable(initialValue, onChange) {
  return new Proxy(
    {
      value: initialValue,
    },
    {
      set: function (target, key, newValue) {
        const oldValue = target["value"];
        if (oldValue !== newValue) {
          target["value"] = newValue;
          onChange(newValue, oldValue);
        }
        return true;
      },
      get: function (target, key) {
        return target["value"];
      },
    }
  );
}
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".findperfecthothub-form form");
  const tve_lead_generated_inputs_container = form.querySelector(
    ".tve_lead_generated_inputs_container"
  );
  const prvBtn = document.querySelector(
    ".findperfecthothub-actions .btn-prev a"
  );
  const nxtBtn = document.querySelector(
    ".findperfecthothub-actions .btn-next a"
  );
  const findperfecthothubTitle = document.querySelector(
    ".findperfecthothub-title p"
  );

  const formStates = [
    {
      step: 1,
      title: "What size hot tub are you thinking about?",
      visibleObjs: [
        {
          type: "radio",
          dataname: "size",
          parentStep: 3,
        },
      ],
    },
    {
      step: 2,
      title:
        "Would you prefer a hot tub with a lounge (lay down seat) or open seating?",
      visibleObjs: [
        {
          type: "radio",
          dataname: "prefer_type",
          parentStep: 3,
        },
      ],
    },
    {
      step: 3,
      title: "What's the main reason for interest in a hot tub?",
      visibleObjs: [
        {
          type: "radio",
          dataname: "main_reason",
          parentStep: 3,
        },
      ],
    },
    {
      step: 4,
      title: "What features or add-ons are you interested in?",
      visibleObjs: [
        {
          type: "radio",
          dataname: "features_or_addons",
          parentStep: 3,
        },
      ],
    },
    {
      step: 5,
      title: "What's your time frame?",
      visibleObjs: [
        {
          type: "radio",
          dataname: "time_frame",
          parentStep: 3,
        },
      ],
    },
    {
      step: 6,
      title:
        "Complete the info below to get instant quiz results with your perfect hot tub and monthly payment info!",
      visibleObjs: [
        {
          type: "input",
          dataname: "ZipCode",
          parentStep: 1,
        },
        {
          type: "input",
          dataname: "First Name",
          parentStep: 5,
        },
        {
          type: "input",
          dataname: "Phone",
          parentStep: 5,
        },
        {
          type: "href",
          dataname: "tve-form-button-submit",
          parentStep: 1,
        },
      ],
    },
  ];

  function getParent(step, root) {
    if (step == 0) {
      return root;
    }
    return getParent(step - 1, root.parentElement);
  }

  function visibleStep(states, step, form, flag = true) {
    const { title, visibleObjs } = states[step];

    if (flag && findperfecthothubTitle) {
      findperfecthothubTitle.innerText = title;
    }

    for (const item of visibleObjs) {
      const { type, dataname, parentStep } = item;
      console.log("[visibleObjs]", item);
      switch (type) {
        case "radio": {
          const ele = form.querySelector(`[data-name="${dataname}"`);
          if (ele) {
            const wrapper = getParent(parentStep, ele);
            if (flag) {
              wrapper.classList.add("active");
            } else {
              wrapper.classList.remove("active");
            }
            console.log("[wrapper]", wrapper);
          }
          break;
        }
        case "input": {
          const ele = form.querySelector(`[data-name="${dataname}"`);
          if (ele) {
            const wrapper = getParent(parentStep, ele);
            if (flag) {
              wrapper.classList.add("active");
            } else {
              wrapper.classList.remove("active");
            }
            console.log("[wrapper]", wrapper);
          }
          break;
        }
        case "href": {
          const ele = form.querySelector(`.${dataname}`);
          if (ele) {
            const wrapper = getParent(parentStep, ele);
            if (flag) {
              wrapper.classList.add("active");
            } else {
              wrapper.classList.remove("active");
            }
            console.log("[wrapper]", wrapper);
          }
          break;
        }
        default: {
        }
      }
    }
  }

  const currentStep = createWatchedVariable(0, function (newValue, oldValue) {
    if (newValue == 0) {
      console.log("[disable button]", prvBtn);
    } else if (newValue == formStates.length) {
      console.log("[disable button]", nxtBtn);
    }
    visibleStep(formStates, oldValue, form, false);
    visibleStep(formStates, newValue, form);
  });

  visibleStep(formStates, 0, form);

  if (prvBtn) {
    prvBtn.addEventListener("click", function () {
      if (currentStep.value > 0) {
        currentStep.value = currentStep.value - 1;
      }
    });
  }
  if (nxtBtn) {
    nxtBtn.addEventListener("click", function () {
      if (currentStep.value < formStates.length - 1) {
        currentStep.value = currentStep.value + 1;
      }
    });
  }
});
