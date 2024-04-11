const fs = require('fs').promises;
const path = require('path');

async function compileMDX() {
    const { createCompiler } = await import('@mdx-js/mdx');

    const mdxDirectory = path.join(__dirname, 'mdx');
    const outputDirectory = path.join(__dirname, 'path', 'to', 'output', 'jsx');

    const mdxFiles = await fs.readdir(mdxDirectory);

    const compiler = createCompiler();

    for (const mdxFile of mdxFiles) {
        const content = await fs.readFile(path.join(mdxDirectory, mdxFile), 'utf8');
        const jsx = await compiler.process(content);
        await fs.writeFile(path.join(outputDirectory, `${mdxFile.replace('.mdx', '')}.js`), jsx);
    }
}

compileMDX().catch(console.error);
