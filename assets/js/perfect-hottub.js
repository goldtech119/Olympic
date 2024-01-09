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
          parentStep: 5,
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
          parentStep: 6,
        },
      ],
    },
  ];
  const rootURL = window.location.protocol + "//" + window.location.host;
  const redirecURLs = {
    type1: `${rootURL}/perfect-hot-tub-results-large-open-seating/`,
    type2: `${rootURL}/perfect-hot-tub-results-large-with-lounge/`,
    type3: `${rootURL}/perfect-hot-tub-results-medium-open-seating/`,
    type4: `${rootURL}/perfect-hot-tub-results-medium-with-lounge/`,
    type5: `${rootURL}/perfect-hot-tub-results-small-open-seating/`,
    type6: `${rootURL}/perfect-hot-tub-results-small-with-lounge/`,
  };

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
            // console.log("[wrapper]", wrapper);
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
            // console.log("[wrapper]", wrapper);
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
            // console.log("[wrapper]", wrapper);
          }
          break;
        }
        case "captcha": {
          const wrapper = form.querySelector(`.${dataname}`);
          if (wrapper) {
            if (flag) {
              wrapper.classList.add("active");
            } else {
              wrapper.classList.remove("active");
            }
            // console.log("[wrapper]", wrapper);
          }
          break;
        }
        default: {
        }
      }
    }
  }
  const evaluatePerfectHottub = ({
    size,
    preferType,
    mainReason,
    featuresAddons,
    timeFrame,
  }) => {
    if (size == "Large" && preferType == "Open seating") return "type1";
    else if (size == "Large" && preferType == "Lounge") return "type2";
    else if (size == "Medium" && preferType == "Open seating") return "type3";
    else if (size == "Medium" && preferType == "Lounge") return "type4";
    else if (size == "Small" && preferType == "Open seating") return "type5";
    else if (size == "Small" && preferType == "Lounge") return "type6";
    return "";
  };

  const currentStep = createWatchedVariable(0, function (curStep, prvStep) {
    if (curStep == 0) {
      prvBtn.style.display = "none";
    } else if (curStep == formStates.length - 1) {
      nxtBtn.style.display = "none";
    } else {
      prvBtn.style.display = "inline-flex";
      nxtBtn.style.display = "inline-flex";
    }

    visibleStep(formStates, prvStep, form, false);
    visibleStep(formStates, curStep, form);
    if (curStep == 5) {
      const selectSize = form.querySelector(`input[data-name="size"]:checked`);
      const size = selectSize ? selectSize.value : "";

      const selectPreferType = form.querySelector(
        `input[data-name="prefer_type"]:checked`
      );
      const preferType = selectPreferType ? selectPreferType.value : "";
      const selectMainReason = form.querySelector(
        `input[data-name="main_reason"]:checked`
      );
      const mainReason = selectMainReason ? selectMainReason.value : "";
      const selectFeaturesAddons = form.querySelector(
        `input[data-name="features_or_addons"]:checked`
      );
      const featuresAddons = selectFeaturesAddons
        ? selectFeaturesAddons.value
        : "";
      const selectTimeFrame = form.querySelector(
        `input[data-name="time_frame"]:checked`
      );
      const timeFrame = selectTimeFrame ? selectTimeFrame.value : "";

      const type = evaluatePerfectHottub({
        size,
        preferType,
        mainReason,
        featuresAddons,
        timeFrame,
      });
      if (type) {
        const url = redirecURLs[type];
        form.querySelector('input[name="_back_url"]').value = url;
      }
      // console.log("[type]", type);
    }
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
