export default function searchImage (query, imageList, rootFile) {
    if (imageList === null) {
        return search(query, rootFile)
    } else {
        return search(query, imageList.files)
    }
}

const search = (query, files) => {
    if (query.length > 3) {
        return files.filter((file) => {
            return file.name.match(query)
        })

    } else {
        return files
    }
}
