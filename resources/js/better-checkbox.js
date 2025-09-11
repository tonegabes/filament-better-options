export default function checkboxListFormComponent({ livewireId }) {
  return {
    areAllCheckboxesChecked: false,
    checkboxListOptions: [],
    search: "",
    visibleCheckboxListOptions: [],

    // Cache selectors for better performance
    selectors: {
      option: ".fi-fo-checkbox-option",
      label: ".fi-fo-checkbox-option__label",
      description: ".fi-fo-checkbox-option__description",
      checkbox: "input[type=checkbox]",
      checkedOrDisabled:
        "input[type=checkbox]:checked, input[type=checkbox]:disabled",
    },

    init() {
      this.cacheElements();
      this.bindEvents();

      this.$nextTick(() => {
        this.checkIfAllCheckboxesAreChecked();
      });
    },

    cacheElements() {
      this.checkboxListOptions = Array.from(
        this.$root.querySelectorAll(this.selectors.option)
      );
      this.updateVisibleCheckboxListOptions();
    },

    bindEvents() {
      // Livewire hook for updates
      Livewire.hook("commit", ({ component, succeed }) => {
        succeed(() => {
          this.$nextTick(() => {
            if (component.id !== livewireId) {
              return;
            }
            this.cacheElements();
            this.checkIfAllCheckboxesAreChecked();
          });
        });
      });

      // Debounced search watcher
      this.$watch(
        "search",
        this.debounce(() => {
          this.updateVisibleCheckboxListOptions();
          this.checkIfAllCheckboxesAreChecked();
        }, 150)
      );
    },

    // Simple debounce implementation
    debounce(func, wait) {
      let timeout;
      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    },

    isFoundInSearch(checkboxItem) {
      if (!this.search || this.search.trim() === "") {
        return true;
      }

      const searchTerm = this.search.toLowerCase();

      // Cache elements to avoid repeated queries
      const labelElement = checkboxItem.querySelector(this.selectors.label);
      const descriptionElement = checkboxItem.querySelector(
        this.selectors.description
      );

      const labelText = labelElement?.innerText?.toLowerCase() || "";
      const descriptionText =
        descriptionElement?.innerText?.toLowerCase() || "";

      return (
        labelText.includes(searchTerm) || descriptionText.includes(searchTerm)
      );
    },

    checkIfAllCheckboxesAreChecked() {
      if (this.visibleCheckboxListOptions.length === 0) {
        this.areAllCheckboxesChecked = false;
        return;
      }

      this.areAllCheckboxesChecked =
        this.visibleCheckboxListOptions.length ===
        this.visibleCheckboxListOptions.filter((checkboxLabel) =>
          checkboxLabel.querySelector(this.selectors.checkedOrDisabled)
        ).length;
    },

    toggleAllCheckboxes() {
      this.checkIfAllCheckboxesAreChecked();
      const shouldCheck = !this.areAllCheckboxesChecked;

      // Batch DOM operations for better performance
      const checkboxesToUpdate = [];

      this.visibleCheckboxListOptions.forEach((checkboxLabel) => {
        const checkbox = checkboxLabel.querySelector(this.selectors.checkbox);
        if (checkbox && !checkbox.disabled) {
          checkboxesToUpdate.push(checkbox);
        }
      });

      // Update all checkboxes at once
      checkboxesToUpdate.forEach((checkbox) => {
        checkbox.checked = shouldCheck;
        checkbox.dispatchEvent(new Event("change"));
      });

      this.areAllCheckboxesChecked = shouldCheck;
    },

    updateVisibleCheckboxListOptions() {
      if (!this.search || this.search.trim() === "") {
        this.visibleCheckboxListOptions = [...this.checkboxListOptions];
        return;
      }

      this.visibleCheckboxListOptions = this.checkboxListOptions.filter(
        (checkboxListItem) => this.isFoundInSearch(checkboxListItem)
      );
    },
  };
}
