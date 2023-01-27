<template>
    <div class="application-wrapper-bottom position-relative">
                <!-- <img :src="loaderImg" alt="" width="100px" height="100px"> -->
        <img :src="loaderImg" alt="" width="100px" height="100px" class="loader_position" v-if="loading">

        <div class="w-100 all-application-column column" v-for="applicationGroup in applicationsGroupData"
            :key="applicationGroup.id">
            <div class="column-title d-flex justify-content-between align-items-center">
                <h4>{{ applicationGroup.name }} ({{ applicationGroup.applications.length }})</h4>
                <group-dropdown v-if="applicationGroup.is_deleteable" :application-group="applicationGroup" @edit-group="editGroup"/>
            </div>

            <draggable class="flex-1 overflow-hidden" v-model="applicationGroup.applications" v-bind="taskDragOptions"
                @end="handleTaskMoved">
                <transition-group
                    class="flex-1 flex flex-col h-full overflow-x-hidden overflow-y-auto rounded shadow-xs" tag="div">
                    <div class="application-card-wrapper" v-for="application in applicationGroup.applications"
                        :key="application.id">
                        <div class="application-card">
                            <div class="appliaction-card-top" data-toggle="modal">
                                <div class="profile-img" v-if="application.candidate.user">
                                    <img width="48px" height="48px" :src="application.candidate.user.image_url" alt="image">
                                </div>
                                <div class="profile-info">
                                    <a href="" class="name" v-if="application.candidate.user">
                                        {{ application.candidate.user.name }}
                                    </a>
                                    <h4 class="designation" v-if="application.candidate.profession">
                                        {{ application.candidate.profession.name }}
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="application-card-bottom">
                                <ul class="lists">
                                    <li v-if="application.candidate.experience">
                                        Experience: {{ application.candidate.experience.name }}
                                    </li>
                                    <li v-if="application.candidate.education">
                                        Education: {{ application.candidate.education.name }}
                                    </li>
                                </ul>
                                <div class="download-cv-btn" v-if="application.candidate_resume_id">
                                    <a @click="downloadCv(application.candidate_resume_id)" href="javascript:void(0)" class="btn">
                                        <span>Download Cv</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition-group>
            </draggable>
        </div>

        <div v-if="showModal">
            <transition name="fade">
                <div class="modal fade show modal-edit" style="display: block;" id="editColumnModal" >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Group</h5>
                                <button type="button" class="btn-close" @click="showModal = false"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="updateGroup">
                                    <div class="form-group">
                                        <label for="name">Group</label>
                                        <input v-model="name" type="text" id="name" placeholder="Name"
                                            class="form-control col-name">
                                        <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3 mb-5">
                                        <button type="button" class="btn btn-secondary" @click="showModal = false">Cancel</button>
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import GroupDropdown from "../GroupDropdown.vue";

export default {
    props: {
        applicationGroups: Array,
    },
    components: {
        draggable,
        GroupDropdown,
    },
    data() {
        return {
            showModal: false,
            applicationsGroupData: [],
            name: "",
            groupId: "",
            errors: {},
            loading: false,
            loaderImg: "/frontend/assets/images/loader.gif",
        };
    },
    methods: {
        handleTaskMoved() {
            this.loading = true;
            axios
                .put("/company/applications/sync", {
                    applicationGroups: this.applicationsGroupData,
                })
                .then((response) => {
                    this.loading = false;
                })
                .catch((err) => {
                    this.loading = false;
                });
        },
        editGroup(name, id) {
            this.showModal = true;
            this.name = name;
            this.groupId = id;
        },
        updateGroup() {
            axios
                .put("/company/applications/group/update", {
                    name: this.name,
                    id: this.groupId,
                })
                .then((response) => {
                    if (response.data.success) {
                        window.location.reload();
                    }
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
        downloadCv(resumeId) {
            axios({
                method: "get",
                url: "/candidates/download/cv/" + resumeId,
                responseType: "blob",
            }).then(function (response) {
                var fileURL = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                var fileLink = document.createElement("a");
                fileLink.href = fileURL;
                fileLink.setAttribute("download", response.headers.filename);
                document.body.appendChild(fileLink);
                fileLink.click();
            });
        },
    },
    computed: {
        taskDragOptions() {
            return {
                animation: 200,
                group: "task-list",
                dragClass: "status-drag",
            };
        },
    },
    mounted() {
        this.applicationsGroupData = JSON.parse(
            JSON.stringify(this.applicationGroups)
        );
    },
};
</script>

<style scoped>
    .status-drag {
        transition: transform 0.5s;
        transition-property: all;
    }


    .modal-edit{
        background:url("http://bin.smwcentral.net/u/11361/BlackTransparentBackground.png");
        z-index:1100;
    }


#editColumnModal .modal-dialog{
    max-width: 536px !important;
}
#editColumnModal .modal-header{
    border: transparent;
    padding-bottom: 0px !important;
    margin-bottom: 16px !important;
}
#editColumnModal .modal-header .modal-title{
    font-weight: 500;
    font-size: 18px;
    line-height: 28px;
    color: var(--gray-900);
}
#editColumnModal .modal-body{
    padding: 0px 32px !important;
}

.loader_position {
    position: absolute;
    top: 50%;
    left: 50%;
}

</style>
