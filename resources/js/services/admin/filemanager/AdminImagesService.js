import {ref} from "vue";
import {root} from "postcss";

export default function useAdminImage() {
    const folders = ref({})
    const files = ref({})

    const getFolders = async () => {
        let response = await axios.get('/api/folders')
        folders.value = response.data
    }

    const getFiles = async (folder) => {
        let response;

        if (folder) {
            response = await axios.get('/api/files?folder=' + folder.name)
        } else {
            response = await axios.get('/api/files')
        }

        files.value = response.data
    }

    const addFileToFolder = async (folder) => {
        if (folder) {
            let index = folders.value.indexOf(folder)

            if (!folders.value[index].files) {
                await getFiles(folder)
                folders.value[index].files =  files.value
            }

            files.value = folders.value[index].files
        } else {
            if (!folders.value['root']) {
                await getFiles()
                folders.value['root'] = {files: files.value}
            }
            files.value = folders.value['root'].files
        }
    }

    const createFolder = async (data) => {
        try {
            await axios.post('/api/folders', data)
            folders.value[0] =  {id: data.name, name: data.name, parent: null}
        } catch (e) {
            for (const key in e.response.data.errors) {
                errors.value[key] += e.response.data.errors[key][0] + ' '
            }
        }
    }

    /**
     * @param {File} file
     * @param {Object} selectFolder
     * @returns {Promise<void>}
     */
    const uploadFile = async (file, selectFolder) => {
        try {
            const fd = new  FormData()
            fd.append("file", file)

            if (selectFolder?.name  ?? null) {
                fd.append("folder", selectFolder.name)
            }

            let response = await axios.post('/api/files', fd,  {
                headers: {
                    "Content-Type": "multipart/form-data",
                }})

            if (selectFolder) {
                let index = folders.value.indexOf(selectFolder)

                if (!folders.value[index].files) {
                    folders.value[index].files = [response.data]
                } else {
                    folders.value[index].files.push(response.data)
                }

            } else {
                if (!folders.value['root']) {
                    folders.value['root'] = {files: [response.data]}
                } else {
                    folders.value['root'].files.push(response.data)
                }
            }
        } catch (e) {
            console.log(e)
        }
    }

    const removeFolder = async (folder) => {
        await axios.delete('/api/folders/' + folder.name, folder)

        let index = folders.value.indexOf(folder)
        folders.value.splice(index, 1)
    }

    const removeFile = async (file) => {
        if (confirm('Voulez vous vraiment supprimer le fichier ?')) {
            await axios.delete('/api/files/' + file.id, file)

            let index = files.value.indexOf(file)
            files.value.splice(index, 1)
        }
    }

    return  {folders, files, getFolders, getFiles, addFileToFolder, createFolder, uploadFile, removeFolder, removeFile}
}
