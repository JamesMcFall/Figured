var FIG = FIG || {};

FIG.general = {

    listen: function () {

        this.initCKEditor();

    },

    /**
     * Init CKEditor
     * Find any textboxes with the .ckeditor class, and initialise them as
     * CKEditor instances.
     *
     * @return <void>
     */
    initCKEditor: function () {

        // Find any matching textareas
        $("textarea.ckeditor").each(function () {

            // Check that CKEditor ClassicEditor is loaded and available so fires don't happen.
            if (typeof ClassicEditor !== "defined") {
                ClassicEditor
                        .create($(this)[0])
                        .catch(error => {
                            console.error(error);
                        });
            }

        });


    }

}

$(function () {
    FIG.general.listen();
});
