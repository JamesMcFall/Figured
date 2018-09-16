var FIG = FIG || {};

FIG.postForm = {

    autoSlug: true,

    listen: function () {

        // FYI setting this as jQuery will take over "this" depending on context.
        var self = this;

        // URL slug auto-population
        self.slugAutoPopulate();

        // Delete Confirmation
        $("a[role=deletePost]").on("click", function (event) {
            self.confirmDelete($(this), event);
        });



    },

    /**
     * Check the user wants to actually delete the article they say.
     *
     * @param <jQuery element> $el - A link
     * @param <JavaScript event>
     * @return <void>
     */
    confirmDelete: function ($el, event) {
        var res = confirm("Are you sure you want to delete '" +
                $el.data('title') + "'?");

        if (!res) {
            event.preventDefault();
        }
    },

    /**
     * As soon as the user types in the slug field, set a data attribute so we
     * know to stop auto populating.
     *
     * @return {[type]} [description]
     */
    slugSet: function () {
        var self = this;
        var $form = $("#postForm");
        var $slug = $("[name=slug]", $form);

        $slug.on("focus", function () {
            self.autoSlug = false;
        });
    },

    slugAutoPopulate: function () {

        var self = this;

        self.slugSet();

        var $form = $("#postForm");
        var $postId = $("[name=postId]", $form);
        var $title = $("[name=title]", $form);
        var $slug = $("[name=slug]", $form);

        // If this page has a post ID in the form, we're editing an existing
        // blog post - so we don't want to touch the value.
        if ($postId.val() != "") {
            self.autoSlug = false;
        }

        $title.on("keyup", function () {

            if (self.autoSlug == false) {
                return;
            }

            var value = $title.val();
            value = value.toLowerCase();
            value = value.replace(/[^\w ]+/g, '')
            value = value.replace(/ +/g, '-');

            $slug.val(value);

        });


    }


}



$(function () {
    FIG.postForm.listen();
});
