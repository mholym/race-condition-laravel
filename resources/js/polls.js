const Polls = {
    start: function() {
        this.forms = document.forms;
        this.bind();
    },

    bind() {
        this.submit();
    },

    submit() {
        for (const form of Polls.forms) {
            const radios = form.getElementsByTagName('input');
            for (const radio of radios) {
                radio.addEventListener('change', function() {
                    form.submit();
                });
            }
        }
    }
};

export default Polls;
