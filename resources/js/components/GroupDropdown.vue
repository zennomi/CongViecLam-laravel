<template>
<div class="dot-icon position-relative">
    <button @click="show = !show" class="btn" id="col-dropdown" data-bs-toggle="dropdown" aria-expanded="false" v-on-clickaway="clickOutside">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="5.5" cy="12" r="1.5" fill="#18191C" />
            <circle cx="12" cy="12" r="1.5" fill="#18191C" />
            <circle cx="18.5" cy="12" r="1.5" fill="#18191C" />
        </svg>
    </button>
    <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown positioning" :class="{'show': show}" >
        <li>
            <a @click="$emit('edit-group', applicationGroup.name, applicationGroup.id)" class="dropdown-item" href="javascript:void(0)">
                <span>Edit</span>
            </a>
        </li>
        <li>
            <a @click="deleteGroup(applicationGroup.id)" class="dropdown-item"
                href="javascript:void(0)">
                <span>Delete</span>
            </a>
        </li>
    </ul>
</div>
</template>

<script>
import { directive as onClickaway } from "vue-clickaway";

export default {
    directives: {
        onClickaway: onClickaway,
    },
    props: {
        applicationGroup: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            show: false,
        };
    },
    methods: {
        deleteGroup(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios
                    .delete("/company/applications/group/delete/" + id)
                    .then((response) => {
                        alert(response.data.message);
                        window.location.reload();
                    })
                    .catch((err) => {
                        console.log(err.response);
                    });
            }
        },
        clickOutside() {
            this.show = false;
        },
    },
};
</script>

<style scoped>
.positioning {
    position: absolute;
    right: 0;
    top: 30px;
}
</style>
